<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class FeatureCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => [
                Rule::unique('feature_categories', 'name')->ignore($id),
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
