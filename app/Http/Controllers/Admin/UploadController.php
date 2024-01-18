<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FileDraft;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $files = $request->file("files");

            if (!is_array($files)) {
                throw new \Exception('No files uploaded');
            }

            $uploadedFiles = [];

            foreach ($files as $file) {
                $pathToImage = Storage::putFile(
                    'public/photos/original',
                    $file
                );

                $fileImg = new FileDraft();
                $fileImg->name = last(explode("/", $pathToImage));
                $fileImg->mime_type = $file->getClientMimeType();
                $fileImg->type = FileDraft::TYPE_IMG;
                $fileImg->path = $pathToImage;
                $fileImg->expired_at = time() + 84600;
                $fileImg->save();

                $uploadedFiles[] = $fileImg;
            }

            return $this->sendSuccess([
                "files" => $uploadedFiles
            ]);
        } catch (\Exception $exception) {
            return $this->sendError($exception->getMessage());
        }
    }

    public function uploadImageTinyCloud(Request $request)
    {
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('file');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs('images/products/description', $imageName, 'public');

        $imageUrl = Storage::url($path);

        return response()->json(['location' => asset($imageUrl)]);
    }
}
