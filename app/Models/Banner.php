<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'position',
        'file_id',
        'slug',
        'status'
    ];

    public function file()
    {
        return $this->belongsTo(File::class, "file_id");
    }
}
