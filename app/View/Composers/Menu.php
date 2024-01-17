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

        $menus = Cache::remember('menus', 3600, function (){
            return $menuItems = \App\Models\Menu::with(['subMenus' => function($query){
                $query->with('subMenus');
            }])->where('parent_id', 0)->take(3)->get()->toArray();
        });

        $view->with([
            'categories' => $categories,
            'menus' => $menus
        ]);
    }
}
