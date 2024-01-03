<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::get();

        return view('admin.attributes.index', [
            'attributes' => $attributes
        ]);
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Attribute name is required',
        ]);

        Attribute::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name'), '-'),
        ]);

        return redirect()->route('admin.attributes.index');
    }

    public function show($id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            dd(404);
        }

        return view('admin.attributes.edit', ['attribute' => $attribute]);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            dd(404);
        }

        $attribute->name = $request->input('name');
        $attribute->code = Str::slug($request->input('name'), '-');
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
