<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFeature;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller
{
    public function index(Request $request)
    {
        return ProductFeature::findOrFail($request->get('id'));
    }

    public function store(Request $request)
    {

    }
}
