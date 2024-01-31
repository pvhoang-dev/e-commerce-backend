<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'feature_id',
        'value',
        'position',
    ];

    public function feature()
    {
        return $this->hasOne(Feature::class, 'feature_id');
    }
}
