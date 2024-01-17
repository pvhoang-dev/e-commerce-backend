<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Banner;
use App\Models\HomePageProduct;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)->get();

        $categoriesHome = Category::where('status', 1)->get();

        $allProducts = HomepageProduct::with('product')->get();

        $groupedProducts = $allProducts->groupBy('group');

        return view('web.home', [
            'banners' => $banners,
            'categoriesHome' => $categoriesHome,
            'groupedProducts' => $groupedProducts
        ]);
    }
}
