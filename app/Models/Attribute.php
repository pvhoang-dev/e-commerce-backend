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
        'name' => 'string',
        'code' => 'string',
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'required',
                Rule::unique('attributes', 'code')->ignore($id),
            ]
        ];
    }

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }
}
