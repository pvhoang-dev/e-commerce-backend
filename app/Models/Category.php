<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'position',
        'description',
        'file_id',
        'status',
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'required',
                Rule::unique('categories', 'slug')->ignore($id),
            ],
            'position' => [
                'required',
            ],
            'parent_id' => [
                'required',
            ],
            'file_id' => [
                'required',
            ],
        ];
    }

    public static function messages(): array
    {
        return [
            'file_id.required' => 'Image is required',
        ];
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'id', 'parent_id');
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id',"file_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
