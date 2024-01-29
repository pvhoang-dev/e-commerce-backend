<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Brand::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $brands = $query->paginate(10);

        return view('admin.brands.index', [
            'brands' => $brands,
            'search' => $search,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBrandRequest $request)
    {
        $input = $request->all();

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }

            $input['file_id'] = $response["id"];
        }

        $brand = Brand::create($input);

        return redirect()->route('admin.brands.edit', [
            'id' => $brand->id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $brand = Brand::find($id);

        if (!$brand) {
            dd(404);
        }

        return view('admin.brands.edit', [
            'brand' => $brand
        ]);
    }

    /**
     * @param UpdateBrandRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $input = $request->all();

        $brand = Brand::find($id);

        if (!$brand) {
            dd(404);
        }

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                $input['file_id'] = $brand->file_id;
            } else {
                $input['file_id'] = $response["id"];
                if ($brand->file_id)
                {
                    FileController::deleteFileWithImage($brand->file_id);
                }
            }
        }

        $brand->update($input);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $brand = Brand::findOrFail($id);

            if ($brand->file_id)
            {
                FileController::deleteFileWithImage($brand->file_id);
            }

            $brand->delete();

            return redirect()->route('admin.brands.index');
        } catch (\Exception $e) {
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.brands.index')
                    ->with('error', 'Cannot delete the brand. Something is wrong !!!');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
