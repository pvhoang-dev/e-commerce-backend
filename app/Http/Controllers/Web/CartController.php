<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributeValue;
use App\Models\ProductVariant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCartFromSession();

        return view('web.cart', [
            'cart' => $cart
        ]);
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            $cart = $this->getCartFromSession();

            $productVariant = ProductVariant::with('product')->find($input['id']);

            $key = $productVariant->id . "-" . $input['option_1'] . "-" . $input['option_2'];

            $arrAttributeValues = $this->getAttributeValues($productVariant->product_id, $productVariant->id);

            if (isset($cart['items'][$key])) {
                $cart['items'][$key]['quantity'] += 1;
            } else {
                $cart['items'][$key] = [
                    "name" => $productVariant->name,
                    "product_id" => $productVariant->product_id,
                    "sku" => $productVariant->sku,
                    "quantity" => 1,
                    "price" => $productVariant->price,
                    "image" => $productVariant->file_id,
                    "attribute" => $arrAttributeValues
                ];
            }

            session()->put('cart', $cart);


            return response()->json([
                'message' => 'Items added successfully'
            ]);
        }
    }

    private function getCartFromSession()
    {
        return session('cart', ['session_id' => Str::uuid()]);
    }

    private function getAttributeValues($product_id, $productVariantId)
    {
        $productAttributeValues = ProductAttributeValue::leftJoin(
            'attribute_values',
            'product_attribute_values.attribute_value_id',
            '=',
            'attribute_values.id'
        )
            ->leftJoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->leftJoin('product_variants', 'product_attribute_values.product_variant_id', '=', 'product_variants.id')
            ->where("product_attribute_values.product_id", $product_id)
            ->select([
                'product_attribute_values.product_variant_id as product_variant_id',
                'attributes.id as attribute_id',
                'attributes.name as attribute_name',
                'attribute_values.id as attribute_values_id',
                'attribute_values.value as attribute_values_value',
            ])->get();

        $arrProductVariants = [];

        foreach ($productAttributeValues as $productAttributeValue) {
            $arrProductVariants[$productAttributeValue->product_variant_id][] = [
                'attr_name' => $productAttributeValue->attribute_name,
                'attr_value' => $productAttributeValue->attribute_values_value,
            ];
        }

        return $arrProductVariants[$productVariantId];
    }
}
