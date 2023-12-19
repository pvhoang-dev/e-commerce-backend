<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'plv_1',
        'plv_2',
        'plv_3',
        'qty',
        'category_id',
        'status',
        'short_description',
        'sku'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
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
}
