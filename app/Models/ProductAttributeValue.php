<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'product_value_id'
    ];

    public function variant()
    {
        return $this->hasOne(ProductVariant::class, "id", "product_variant_id");
    }

    public function attributeValue()
    {
        return $this->hasOne(AttributeValue::class, "id", "attribute_value_id");
    }
}
