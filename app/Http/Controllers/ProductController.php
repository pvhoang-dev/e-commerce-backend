<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Services\File\MakeFinalFileService;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();

        $products = Product::with(['images' => function ($query) {
            $query->where('type', 1);
        }])->where('status', 1)->paginate(10);

        return view('admin.products.index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $arrProductImg = [];

        $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'plv_1' => 'required',
            'plv_2' => 'required',
            'plv_3' => 'required',
        ], [
            'name.required' => 'Product name is required',
            'qty.required' => 'Quantity is required',
            'plv_1.required' => 'Plv_1 is required',
            'plv_2.required' => 'Plv_2 is required',
            'plv_3.required' => 'Plv_3 is required',
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'sku' => 'N&H' . Str::upper(Str::random(4)),
            'category_id' => $request->input('category_id'),
            'plv_1' => $request->input('plv_1'),
            'plv_2' => $request->input('plv_2'),
            'plv_3' => $request->input('plv_3'),
            'qty' => $request->input('qty'),
            'short_description' => $request->input('short_description'),
            'status' => 1
        ]);

        if ($request->has('file_id')) {
            foreach ($request->get('file_id') as $file_id) {
                $response = MakeFinalFileService::convertDraftToFinal($file_id);

                if (!$response["status"]) {
                    return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
                }

                $arrProductImg[] = [
                    'file_id' => $file_id,
                    'type' => 0,
                    'product_id' => $product->id,
                ];
            }

            $arrProductImg[0]['type'] = 1;

            ProductImage::insert($arrProductImg);
        }

        return redirect()->route('admin.products.index');
    }

    public function show($id)
    {
        $categories = Category::get();

        $product = Product::find($id);

        $productVariants = ProductVariant::where('product_id', $product->id)->paginate(5);

        if (!$product) {
            dd(404);
        }

        return view('admin.products.edit', [
            'product' => $product,
            'productVariants' => $productVariants,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $arrProductImg = [];

        $tmp = true;

        $product = Product::find($id);

        if ($product->images->where('type', 1)->count() > 0) {
            $tmp = false;
        }

        if ($request->has('file_id')) {
            foreach ($request->get('file_id') as $file_id) {
                $response = MakeFinalFileService::convertDraftToFinal($file_id);

                if (!$response["status"]) {
                    return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
                }

                $arrProductImg[] = [
                    'file_id' => $file_id,
                    'type' => 0,
                    'product_id' => $product->id,
                ];
            }

            if ($tmp)
                $arrProductImg[0]['type'] = 1;
        }

        ProductImage::insert($arrProductImg);

        $product->slug = Str::slug($request->input('name'), '-');

        $product->update($request->all());

        return redirect()->route('admin.products.index');
    }

    public function delete()
    {
    }
}
