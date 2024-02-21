<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $productVariants = ProductVariant::where('product_id', 2)->with('discount')->get();

        dd($productVariants->count());
    }
}
