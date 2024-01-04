<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string'
    ];

    public static function getValidationRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('attributes', 'name')->ignore($id),
            ],
        ];
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }
}
