<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'sku',
        'qty',
        'plv_1',
        'plv_2',
        'plv_3',
        'status'
    ];

    public static function getValidationRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_variants', 'name')->ignore($id),
            ],
            'qty' => [
                'required',
            ],
            'plv_1' => [
                'required',
            ],
            'plv_2' => [
                'required',
            ],
            'plv_3' => [
                'required',
            ],
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_variant_id", "id");
    }
}
