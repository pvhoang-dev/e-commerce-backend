<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Banner::query();

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $banners = $query->paginate(10);

        return view('admin.banners.index', [
            'banners' => $banners,
            'search' => $search,
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

        $banner = Banner::create($input);

        return redirect()->route('admin.banners.edit', [
            'id' => $banner->id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
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
                if ($banner->file_id) {
                    FileController::deleteFileWithImage($banner->file_id);
                }
            }
        }

        $banner->update($input);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $banner = Banner::findOrFail($id);

            if($banner->id)
            {
                FileController::deleteFileWithImage($banner->file_id);
            }

            $banner->delete();

            DB::commit();

            return redirect()->route('admin.banners.index');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.banners.index')
                    ->with('error', 'Cannot delete the banner. Something is wrong !!!');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
