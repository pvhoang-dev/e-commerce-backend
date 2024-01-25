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
        $menus = Menu::paginate(10);

        return view('admin.menus.index', [
            'menus' => $menus
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $menus = Menu::with(['subMenus' => function($query){
            $query->with('subMenus');
        }])->where('parent_id', 0)->get()->toArray();

        return view('admin.menus.create', [
            'menus' => $menus
        ]);
    }

    /**
     * @param CreateMenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateMenuRequest $request)
    {
        $input = $request->all();

        $menu = Menu::create($input);

        return redirect()->route('admin.menus.edit', [
            'id' => $menu->id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            dd(404);
        }

        $menus = Menu::with(['subMenus' => function($query){
            $query->with('subMenus');
        }])->where('parent_id', 0)->get()->toArray();

        return view('admin.menus.edit', [
            'menus' => $menus,
            'menu' => $menu
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuRequest $request, $id)
    {
        $input = $request->all();

        $menu = Menu::find($id);

        if (!$menu) {
            dd(404);
        }

        $menu->update($input);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $subMenus = Menu::where('parent_id', $id)->first();

            if($subMenus){
                return redirect()->route('admin.menus.index')
                    ->with('error', 'Cannot delete the menu. It is associated with sub records.');
            }

            $menu->delete();

            return redirect()->route('admin.menus.index');
        } catch (\Exception $e) {
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.menus.index')
                    ->with('error', 'Cannot delete the menu. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
