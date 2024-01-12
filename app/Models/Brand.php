<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'file_id',
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('brands', 'slug')->ignore($id),
            ],
        ];
    }

    public function file()
    {
        return $this->hasOne(File::class, "id", "file_id");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "brand_id", "id");
    }
}
