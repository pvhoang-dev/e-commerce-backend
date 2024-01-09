<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $input = $request->all();

        $input['slug'] = Str::slug($request->input('title'), '-');

        $input['status'] = 1;

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $input['slug'] = Str::slug($request->input('title'), '-');

        if ($request->has('file_id')) {
            $response = MakeFinalFileService::convertDraftToFinal($input['file_id']);

            if (!$response["status"]) {
                return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
            }
        }

        $banner = Banner::find($id);

        $banner->update($input);

        return redirect()->route('admin.banners.index');
    }

    public function delete()
    {
    }
}
