<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDraft extends Model
{
    use HasFactory;

    const TYPE_IMG = 1;
    
    protected $fillable = [
        'name',
        'path',
        'type',
        'mime_type',
        'expired_at'
    ];
}
