<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value'
    ];

    public static function getValidationRules($id = null)
    {
        return [
            'attribute_id' => [
                'required',
            ],
            'value' => [
                'required',
                'string',
                'max:255',
                static::uniqueAttributeValueRule($id),
            ],
        ];
    }

    public static function uniqueAttributeValueRule($id)
    {
        return Rule::unique('attribute_values', 'value')->where(function ($query) use ($id) {
            $query->where('attribute_id', request()->input('attribute_id'));
        })->ignore($id);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
