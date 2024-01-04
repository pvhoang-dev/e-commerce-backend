<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CreateProductRequest;
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
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        Paginator::useBootstrap();

        $products = Product::with(['images' => function ($query) {
            $query->where('type', 1);
        }])->where('status', 1)->paginate(10);

        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        $arrProductImg = [];

        $input = $request->all();

        $product = Product::create($input);

        if ($request->has('file_id')) {
            foreach ($request->get('file_id') as $file_id) {
                $response = MakeFinalFileService::convertDraftToFinal($file_id);

                if (!$response["status"]) {
                    return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
                }

                $arrProductImg[] = [
                    'file_id' => $response["id"],
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
