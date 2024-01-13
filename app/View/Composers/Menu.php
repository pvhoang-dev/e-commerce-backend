<?php


namespace App\View\Composers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;


class Menu
{
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 3600, function () {
            return Category::where('parent_id', 0)->take(3)->get();
        });

        $view->with('categories', $categories);
    }
}