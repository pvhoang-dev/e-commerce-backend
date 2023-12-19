<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index()
    {
        $attributeValues = AttributeValue::get();

        return view('admin.atribute_values.index', ['attributeValues' => $attributeValues]);
    }

    public function create()
    {
        $attributes = Attribute::get();

        return view('admin.atribute_values.create', ['attributes' => $attributes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required',
            'value' => 'required',
        ], [
            'attribute_id.required' => 'Attribue name is required',
            'value.required' => 'Attribue value is required',
        ]);

        AttributeValue::create([
            'attribute_id' => $request->input('attribute_id'),
            'value' => $request->input('value'),
        ]);

        return redirect()->route('admin.attribute_values.index');
    }

    public function show($id)
    {
        $attributes = Attribute::get();

        $attributeValue = AttributeValue::find($id);

        return view('admin.atribute_values.edit', [
            'attributeValue' => $attributeValue,
            'attributes' => $attributes
        ]);
    }

    public function update(Request $request, $id)
    {
        $attributeValue = AttributeValue::find($id);

        if(!$attributeValue){
            dd(404);
        }

        $attributeValue->update($request -> all());

        return redirect()->route('admin.attribute_values.index');
    }

    public function delete()
    {
        
    }
}
