<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileDraft;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FileController extends Controller
{
    public function index($fileId)
    {
        $cacheKey = 'file' . $fileId;

        if (Cache::has($cacheKey)) {
            $file = Cache::get($cacheKey);
        } else {
            $file = File::find($fileId);

            // if (empty($file)) {
            //     return response()->file(storage_path("app/public/images/default_image.jpg"), array(
            //         'Content-Type' => 'image/jpeg'
            //     ));
            // }

            Cache::put($cacheKey, $file, 86400);
        }
        return response()->file(storage_path("app/" . $file->path), array('Content-Type' => $file->mime_type));
    }

    /**
     * @param $fileId
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * Draft
     */
    public function draft($fileId)
    {
        $file = FileDraft::find($fileId);

        return response()->file(storage_path("app/" . $file->path), array('Content-Type' => $file->mime_type));
    }

    public function delete($id)
    {
        $fileId = FileDraft::where('id', $id)
            ->first();

        unlink(storage_path("app/" . $fileId->path));

        $fileId->delete();

        return redirect()->back();
    }
}
