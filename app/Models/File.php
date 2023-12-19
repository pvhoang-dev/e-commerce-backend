<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class File extends Model
{
    use HasFactory;

    const TYPE_IMG = 1;

    const IMG_DEFAULT = 0;

    protected $fillable = [
        'name',
        'path',
        'type',
        'mime_type'
    ];
}