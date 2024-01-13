<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAttributeValue;

class ProductDetailController extends Controller
{
    public function index($id)
    {
        $product = Product::with('category')->find($id);

        $productAttributeValues = ProductAttributeValue::leftJoin('attribute_values', 'product_attribute_values.attribute_value_id', '=', 'attribute_values.id')
            ->leftJoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->where("product_attribute_values.product_id", $id)
            ->select([
                'product_attribute_values.product_variant_id as product_variant_id',
                'attributes.id as attribute_id',
                'attributes.name as attribute_name',
                'attributes.code as attribute_code',
                'attribute_values.id as attribute_values_id',
                'attribute_values.value as attribute_values_value',
            ])
            ->get();

        $productVariants = [];

        foreach ($productAttributeValues as $productAttributeValue) {
            $productVariants[$productAttributeValue->product_variant_id][$productAttributeValue->attribute_id] = [
                'attr_name' => $productAttributeValue->attribute_name,
                'attr_value' => $productAttributeValue->attribute_values_value,
                'attr_code' => $productAttributeValue->attribute_code,
            ];
        }

        $categoryProducts = Product::inRandomOrder()->limit(5)->where([
            ['category_id', '=', $product->category_id],
            ['id', '<>', $product->id],
        ])->get();

        return view('web.detail', [
            'product' => $product,
            'productVariants' => $productVariants,
            'categoryProducts' => $categoryProducts
        ]);
    }
}
