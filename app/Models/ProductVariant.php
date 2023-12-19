<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productAttributeValue()
    {
        return $this->hasMany(ProductAttributeValue::class, "product_variant_id", "id");
    }
}
