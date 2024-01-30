<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Feature;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getAttributeValue(Request $request)
    {
        if (!isset($request->attribute_id))
            return '';

        $attributeValues = AttributeValue::where("attribute_id", $request->attribute_id)->get();
        $str = '<option value="0">No select</option>';
        foreach ($attributeValues as $value) {
            $str .= '<option value="' . $value->id . '">' . $value->value . '</option>';
        }

        return $str;
    }

    public function getFeature(Request $request)
    {
        if (!isset($request->feature_category_id))
            return '';

        $features = Feature::where("feature_category_id", $request->feature_category_id)->get();
        $str = '';
        foreach ($features as $value) {
            $str .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }

        return $str;
    }
}
