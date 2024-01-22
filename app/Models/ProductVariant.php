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
        'price',
        'status',
        'file_id'
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
                Rule::unique('product_variants', 'slug')->ignore($id),
            ],
            'qty' => [
                'required',
            ],
            'price' => [
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
