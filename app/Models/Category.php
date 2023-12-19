<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'position',
        'file_id',
        'status',
    ];

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, "file_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
