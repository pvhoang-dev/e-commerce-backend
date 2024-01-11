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
}
