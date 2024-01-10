<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\File\MakeFinalFileService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $banners = Banner::all();

        return view('admin.banners.index', [
            'banners' => $banners
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBannerRequest $request)
    {
        $input = $request->all();

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }

            $input['file_id'] = $response["id"];
        }

        Banner::create($input);

        return redirect()->route('admin.banners.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            dd(404);
        }

        return view('admin.banners.edit', [
            'banner' => $banner
        ]);
    }

    /**
     * @param UpdateBannerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $input = $request->all();

        $banner = Banner::find($id);

        if (!$banner) {
            dd(404);
        }

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                $input['file_id'] = $banner->file_id;
            } else {
                $input['file_id'] = $response["id"];
            }
        }

        $banner->update($input);

        return redirect()->route('admin.banners.index');
    }

    public function delete()
    {
    }
}
