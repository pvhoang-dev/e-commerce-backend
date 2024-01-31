<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFeature;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller
{
    public function index(Request $request)
    {
        $productFeature = ProductFeature::find($request->get('id'));

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
        $productFeature = ProductFeature::firstOrNew($request->get('id'));

    }
}
