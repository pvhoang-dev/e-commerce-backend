<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileDraft;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function index($fileId)
    {
        /*
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

            // Cache::put($cacheKey, $file, 86400);
        }
        */
        $file = File::find($fileId);

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

    public function deleteDraft($id)
    {
        try {
            $file = FileDraft::findOrFail($id);

            unlink(storage_path("app/" . $file->path));

            $file->delete();

            return response()->json(['message' => 'File deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete file'], 500);
        }
    }

    /**
     * @param $id
     */
    public static function deleteFileWithImage($id)
    {
        try {
            DB::beginTransaction();

            $file = File::findOrFail($id);

            unlink(storage_path("app/" . $file->path));

            $file->delete();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }

    public static function deleteMultiFileWithImage($ids)
    {
        try {
            DB::beginTransaction();

            foreach ($ids as $id)
            {
                $file = File::findOrFail($id);

                $file->delete();

                unlink(storage_path("app/" . $file->path));
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }
}
