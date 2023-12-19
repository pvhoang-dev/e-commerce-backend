<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\File\MakeFinalFileService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('admin.categories.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $input['slug'] = Str::slug($request->input('name'), '-');

        $input['status'] = 1;

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }
        }

        Category::create($input);

        return redirect()->route('admin.categories.index');
    }

    public function show($id)
    {
        $category = Category::find($id);

        $categories = Category::where('parent_id', 0)->get();

        if (!$category) {
            dd(404);
        }

        return view('admin.categories.edit', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $input['slug'] = Str::slug($request->input('name'), '-');

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }
        }

        $category = Category::find($id);

        $category->update($input);

        return redirect()->route('admin.categories.index');
    }

    public function delete()
    {
    }
}
