<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brands.index', [
            'brands' => $brands
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

        Brand::create($input);

        return redirect()->route('admin.brands.index');
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
            }
        }

        $brand->update($input);

        return redirect()->route('admin.brands.index');
    }
}
