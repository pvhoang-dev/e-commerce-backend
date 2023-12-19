<?php

namespace App\Services\File;

use App\Models\File;
use App\Models\FileDraft;

class MakeFinalFileService
{

    public static function  convertDraftToFinal($file_id)
    {
        $fileDraft = FileDraft::find($file_id);

        if (empty($fileDraft)) {
            return [
                "status" => false,
                "message" => "File id is not exist!",
                "file" => []
            ];
        }

        $file = new File();
        $file->id = $fileDraft->id;
        $file->name = $fileDraft->name;
        $file->type = $fileDraft->type;
        $file->path = $fileDraft->path;
        $file->mime_type = $fileDraft->mime_type;
        $file->save();

        $fileDraft->delete();

        return [
            "status" => true,
            "message" => "success",
            "file" => $file
        ];
    }
}
