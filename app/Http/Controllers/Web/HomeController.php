<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Banner;
use App\Models\HomePageProduct;
use App\Enums\BannerEnum;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::whereIn('slot', [BannerEnum::BannerLeft, BannerEnum::BannerRight, 3])->get();

        $bannerLeft = $banners->where('slot', BannerEnum::BannerLeft);

        $bannerRight = $banners->where('slot', BannerEnum::BannerRight);

        $bannerButton = $banners->where('slot', 3);

        $categoriesHome = Category::where('status', 1)->get();

        $allProducts = HomepageProduct::with('product')->get();

        $groupedProducts = $allProducts->groupBy('group');

        return view('web.home', [
            'banners' => $banners,
            'categoriesHome' => $categoriesHome,
            'groupedProducts' => $groupedProducts,
            'bannerLeft' => $bannerLeft,
            'bannerRight' => $bannerRight,
        ]);
    }
}
