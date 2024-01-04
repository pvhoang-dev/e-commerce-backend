<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateAttributeValueRequest;
use App\Http\Requests\Admin\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $attributeValues = AttributeValue::get();

        return view('admin.attribute_values.index', ['attributeValues' => $attributeValues]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $attributes = Attribute::get();

        return view('admin.attribute_values.create', ['attributes' => $attributes]);
    }

    /**
     * @param CreateAttributeValueRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeValueRequest $request)
    {
        $input = $request->all();

        AttributeValue::create($input);

        return redirect()->route('admin.attribute_values.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $attributes = Attribute::get();

        $attributeValue = AttributeValue::find($id);

        if (!$attributeValue) {
            dd(404);
        }

        return view('admin.attribute_values.edit', [
            'attributeValue' => $attributeValue,
            'attributes' => $attributes
        ]);
    }

    /**
     * @param UpdateAttributeValueRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeValueRequest $request, $id)
    {
        $attributeValue = AttributeValue::find($id);

        if (!$attributeValue) {
            dd(404);
        }

        $input = $request->all();

        $attributeValue->update($input);

        return redirect()->route('admin.attribute_values.index');
    }

    public function delete()
    {

    }
}
