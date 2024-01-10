<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'position',
        'file_id',
        'url',
        'status'
    ];

    public static function getValidationRules($id = null)
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'slug' => [
                Rule::unique('banners', 'slug')->ignore($id),
            ],
            'url' => [
                'required',
                'string',
                'max:255',
            ],
            'position' => [
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

    public function file()
    {
        return $this->belongsTo(File::class, "id", "file_id");
    }
}
