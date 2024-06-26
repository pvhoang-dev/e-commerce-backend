<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductVariantRequest;
use App\Http\Requests\Admin\UpdateProductVariantRequest;
use App\Http\Requests\Admin\UpdateVariantDiscountRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use App\Models\ProductPromotion;
use App\Models\ProductVariant;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    public function index()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $attributes = Attribute::get();

        $productId = $request->get("product_id");

        $product = Product::with([
            'productAttributeValue' => function ($query) {
                $query->where('product_variant_id', '>', 0);
            },
            'productAttributeValue.attributeValue'
        ])
            ->where("id", $productId)
            ->first();

        $variantAttribute = $attributeValue = [];

        if (!empty($product->productAttributeValue)) {
            foreach ($product->productAttributeValue as $value) {
                $variantAttribute[] = $value->attributeValue->attribute_id;
            }
        }

        if (!empty($variantAttribute)) {
            $attributeValue = AttributeValue::whereIn("attribute_id", $variantAttribute)->get();
        }

        $productImages = ProductImage::where('product_id', $productId)->get();

        return view('admin.product_variants.create', [
            'attributes' => $attributes,
            'variantAttribute' => $variantAttribute,
            'variantAttributeValue' => $attributeValue,
            'product' => $product,
            'productImages' => $productImages
        ]);
    }

    /**
     * @param CreateProductVariantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductVariantRequest $request)
    {
        $input = $request->all();

        $product = Product::find($input["product_id"]);

        $result = $this->variantAttributeValidate(
            $input["product_id"],
            $input["attribute_id_1"],
            $input["attribute_value_id_1"] ?? 0,
            $input["attribute_id_2"] ?? 0,
            $input["attribute_value_id_2"] ?? 0
        );

        if (!$result["status"]) {
            dd($result["message"]);

            return redirect()->back();
        }

        $variant = ProductVariant::create($input);

        $this->checkAndUpdatePriceProduct($variant->toArray(), 'create');

        $this->createProductVariantAttribute(
            $input["product_id"],
            $variant->id,
            [$input["attribute_value_id_1"], $input["attribute_value_id_2"] ?? 0]
        );

        $product->qty += $variant->qty;

        $product->save();

        return redirect()->route('admin.product_variants.edit', ['id' => $variant->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $productVariant = ProductVariant::with([
            'productAttributeValue',
            'productAttributeValue.attributeValue',
            'productAttributeValue.attributeValue.attribute'
        ])->find($id);

        if (!$productVariant) {
            dd(404);
        }

        $product = Product::find($productVariant->product_id);

        $productImages = ProductImage::where('product_id', $productVariant->product_id)->get();

        $productPromotion = ProductPromotion::where('product_variant_id', $productVariant->id)->first();

        return view('admin.product_variants.edit', [
            'product' => $product,
            'productVariant' => $productVariant,
            'productImages' => $productImages,
            'productPromotion' => $productPromotion
        ]);
    }

    public function checkAndUpdatePriceProduct($data, $status = '')
    {
        if ($status == 'create') {
            $productPromotion = new ProductPromotion();
            $productPromotion->product_id = $data['product_id'];
            $productPromotion->product_variant_id = $data['id'];
            $productPromotion->product_variant_sku = $data['sku'];
            $productPromotion->discount_percent = 0;
            $productPromotion->start_date = 0;
            $productPromotion->end_date = 0;
            $productPromotion->status = 1;

            $productPromotion->save();
        }

        $product = Product::find($data['product_id']);

        $productVariants = ProductVariant::where('product_id', $data['product_id'])->with('discount')->get();

        if ($status == 'delete' && $productVariants->count() == 0) {
            $product->update([
                'price' =>  0,
                'promotion_price' => 0,
                'product_promotion_id' => 0,
                'status' => 0
            ]);

            return;
        }

        $key = 0;

        $realPriceProduct = $product['promotion_price'];

        foreach ($productVariants as $productVariant)
        {
            if($productVariant->discount) {
                $realPriceVariant = $productVariant->price - $productVariant->discount->discount_percent * $productVariant->price / 100;

                if ($productVariants->count() == 1)
                {
                    $product->update([
                        'price' =>  $productVariant->price,
                        'promotion_price' => $realPriceVariant,
                        'product_promotion_id' => $productVariant->discount->id,
                    ]);

                    return;
                }

                if($realPriceVariant < $realPriceProduct)
                {
                    $key = $productVariant->id;

                    $realPriceProduct = $realPriceVariant;
                }
            }
        }

        if($key)
        {
            $dataVariant = $productVariants->find($key);

            $product->update([
                'price' =>  $dataVariant->price,
                'promotion_price' => $realPriceProduct,
                'product_promotion_id' => $dataVariant->discount->id,
            ]);
        }
    }

    /**
     * @param UpdateProductVariantRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductVariantRequest $request, $id)
    {
        $input = $request->all();

        $product = Product::find($input["product_id"]);

        $productVariant = ProductVariant::find($id);

        if (!$productVariant) {
            dd(404);
        }

        $product->qty = $product->qty - $productVariant->qty + $input["qty"];

        $productVariant->update($input);

        $product->save();

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $productVariant = ProductVariant::findOrFail($id);

            $product = Product::find($productVariant->product_id);

            ProductAttributeValue::where('product_variant_id', $id)->delete();

            $productVariant->delete();

            $product->qty = $product->qty - $productVariant->qty > 0 ? $product->qty - $productVariant->qty : 0;

            $this->checkAndUpdatePriceProduct($productVariant->toArray(), 'delete');

            $product->save();

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->back()
                    ->with('error', 'Cannot delete the product variant. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }

    /**
     * @param UpdateVariantDiscountRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDiscount(UpdateVariantDiscountRequest $request, $id)
    {
        $productVariant = ProductVariant::findOrFail($id);

        $input = $request->all();

        $productPromotion = ProductPromotion::firstOrNew(['product_variant_id' => $id]);

        if (!$productPromotion->exists) {
            $productPromotion->product_id = $productVariant->product_id;
            $productPromotion->product_variant_id = $id;
            $productPromotion->product_variant_sku = $productVariant->sku;
        }

        $productPromotion->fill($input);

        $productPromotion->save();

        $this->checkAndUpdatePriceProduct($productVariant->toArray(), 'updateDiscount');

        return redirect()->back();
    }

    /**
     * @param $product_id
     * @param $variant_id
     * @param $aryAttributeValue
     * @return bool
     */
    public function createProductVariantAttribute($product_id, $variant_id, $aryAttributeValue = [])
    {
        foreach ($aryAttributeValue as $attribute_value) {
            if ($attribute_value == 0) continue;

            $productAttribute = new ProductAttributeValue();
            $productAttribute->product_id = $product_id;
            $productAttribute->product_variant_id = $variant_id;
            $productAttribute->attribute_value_id = $attribute_value;
            $productAttribute->save();
        }

        return true;
    }

    /**
     * @param $product_id
     * @param int $attr1
     * @param int $attrValue1
     * @param int $attr2
     * @param int $attrValue2
     * @return array
     */
    public function variantAttributeValidate($product_id, $attr1, $attrValue1 = 0, $attr2 = 0, $attrValue2 = 0)
    {
        if ($attr1 == $attr2)
            return ["status" => false, "message" => "Duplicate Attribute"];

        if ($attrValue1 == $attrValue2)
            return ["status" => false, "message" => "Duplicate Attribute Value"];

        $product = Product::with(['productAttributeValue' => function ($query) {
            $query->where('product_variant_id', '>', 0);
        }, "productAttributeValue.attributeValue"])->where("id", $product_id)->first();

        if ($product->productAttributeValue->count() == 0)
            return ["status" => true, "messages" => ""];

        $aryAttrId = $attributeValueKey = [];

        foreach ($product->productAttributeValue as $attributeValue) {
            if (count($aryAttrId) < 3)
                $aryAttrId[$attributeValue->attributeValue->attribute_id] = $attributeValue->attributeValue->attribute_id;

            if (isset($attributeValueKey[$attributeValue->product_variant_id])) {
                $attributeValueKey[$attributeValue->product_variant_id] .= "_" . $attributeValue->attribute_value_id;
                continue;
            }

            $attributeValueKey[$attributeValue->product_variant_id] = $attributeValue->attribute_value_id;
        }

        $valueKey = '';

        if ($attrValue1 != 0)
            $valueKey = $attrValue1;

        if ($attr2 != 0)
            $valueKey = $valueKey . "_" . $attrValue2;

        if (in_array($valueKey, $attributeValueKey))
            return ["status" => false, "message" => "Attribute available !"];

        if ($attr1 != 0) {
            if (!in_array($attr1, $aryAttrId))
                return ["status" => false, "message" => "Attribute 1 ID not in array !"];
        }

        if ($attr2 != 0) {
            if (!in_array($attr2, $aryAttrId))
                return ["status" => false, "message" => "Attribute 2 ID not in array !"];
        }

        $attrValues = AttributeValue::whereIn("id", [$attrValue1, $attrValue2])->get();
        foreach ($attrValues as $val) {
            if (!in_array($val->attribute_id, $aryAttrId))
                return ["status" => false, "message" => "Attribute value 1 ID not in array !"];
        }

        return ["status" => true, "messages" => ""];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->get('id');

            $productVariant = ProductVariant::findOrFail($id);

            if ($productVariant->status == 1) {
                $productVariant->update(['status' => 0]);

                return response()->json(['success' => true, 'status' => 0, 'message' => 'Update status successfully']);
            } else {
                if ($productVariant->qty <= 0) {
                    return response()->json(['success' => false, 'message' => 'Quantity variant need to > 10']);
                } else {
                    $productVariant->update(['status' => 1]);

                    return response()->json(['success' => true, 'status' => 1, 'message' => 'Update status successfully']);
                }
            }

        } else {
            return response()->json(['success' => false, 'message' => 'Variant not exist']);
        }
    }
}
