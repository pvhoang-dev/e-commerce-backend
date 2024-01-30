<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'feature_category_id',
        'position',
    ];

    public function featureCategory()
    {
        return $this->belongsTo(FeatureCategory::class, "feature_category_id");
    }
}
