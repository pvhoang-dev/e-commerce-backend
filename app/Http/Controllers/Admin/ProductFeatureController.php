<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFeature;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller
{
    public function index(Request $request)
    {
        $productFeature = ProductFeature::where([
            'product_id' => $request->get('product_id'),
            'feature_id' => $request->get('feature_id'),
        ])->first();

        if(!$productFeature)
        {
            return [
                'value' => "",
            ];
        }

        return $productFeature;
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $productFeature = ProductFeature::firstOrNew([
            'product_id' => $input['product_id'],
            'feature_id' => $input['preview_feature_name'],
        ]);

        $productFeature->value = $input['feature_value'] ?? '';
        $productFeature->position = 0;

        $productFeature->save();
    }
}
