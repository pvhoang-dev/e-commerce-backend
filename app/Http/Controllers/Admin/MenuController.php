<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateMenuRequest;
use App\Http\Requests\Admin\UpdateMenuRequest;
use App\Models\Menu;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $menus = Menu::all();

        return view('admin.menus.index', [
            'menus' => $menus
        ]);
    }
}
