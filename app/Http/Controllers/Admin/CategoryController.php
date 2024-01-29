<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Category::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $categories = $query->paginate(10);

        return view('admin.categories.index', [
            'categories' => $categories,
            'search' => $search,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('admin.categories.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }

            $input['file_id'] = $response["id"];
        }

        $category = Category::create($input);

        return redirect()->route('admin.categories.edit', [
            'id' => $category->id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);

        if (!$category) {
            dd(404);
        }

        $categories = Category::where('parent_id', 0)->get();

        return view('admin.categories.edit', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $input = $request->all();

        $category = Category::find($id);

        if (!$category) {
            dd(404);
        }

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response['status']) {
                $input['file_id'] = $category->file_id;
            } else {
                $input['file_id'] = $response['id'];
                if ($category->file_id) {
                    FileController::deleteFileWithImage($category->file_id);
                }
            }
        }

        $category->update($input);

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);

            $subCategories = Category::where('parent_id', $id)->first();

            if($subCategories){
                return redirect()->route('admin.categories.index')
                    ->with('error', 'Cannot delete the category. It is associated with sub records.');
            }

            if($category->id)
            {
                FileController::deleteFileWithImage($category->file_id);
            }

            $category->delete();

            DB::commit();

            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.categories.index')
                    ->with('error', 'Cannot delete the category. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
