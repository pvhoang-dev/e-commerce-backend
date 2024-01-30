<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category_id',
        'brand_id',
        'price',
        'promotion_price',
        'product_promotion_id',
        'qty',
        'short_description',
        'status',
        'type',
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
                Rule::unique('products', 'slug')->ignore($id),
            ],
            'category_id' => [
                'required',
            ],
            'brand_id' => [
                'required',
            ],
            'price' => [
                'required',
                'numeric',
                'gte:0',
            ],
            'qty' => [
                'numeric',
                'gte:0',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, "brand_id");
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_id", "id");
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, "product_id");
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class, 'product_id');
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class, "product_id");
    }
}
