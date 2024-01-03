<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $attributes = Attribute::get();

        return view('admin.attributes.index', [
            'attributes' => $attributes
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * @param CreateAttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request)
    {
        $input = $request->all();

        Attribute::create([
            'name' => $input['name'],
            'code' => Str::slug($input['name'], '-'),
        ]);

        return redirect()->route('admin.attributes.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);

        if (empty($attribute)) {
            return redirect(route('admin.attributes.index'));
        }

        return view('admin.attributes.edit', [
            'attribute' => $attribute,
        ]);
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            dd(404);
        }

        $input = $request->all();

        $attribute->name = $input['name'];
        $attribute->code = Str::slug($input['name'], '-');
        $attribute->save();

        return redirect()->route('admin.attributes.index');
    }

    public function delete($id){
        $attribute = Attribute::find($id);

        if (!$attribute) {
            dd(404);
        }

        $attribute->delete();

        return redirect()->route('admin.attributes.index');
    }
}
