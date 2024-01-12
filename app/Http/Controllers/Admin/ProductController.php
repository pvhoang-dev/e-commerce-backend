<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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

        $brands = Category::all();

        return view('admin.products.create', [
            'categories' => $categories,
            'brands' => $brands,
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

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            dd(404);
        }

        $productVariants = ProductVariant::where('product_id', $product->id)->paginate(5);

        $categories = Category::get();

        $brands = Brand::get();

        return view('admin.products.edit', [
            'product' => $product,
            'productVariants' => $productVariants,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
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
                        'file_id' => $response["id"],
                        'type' => 0,
                        'product_id' => $id,
                    ];
                }

                if ($tmp)
                    $arrProductImg[0]['type'] = 1;
            }

            DB::beginTransaction();

            try {
                ProductImage::insert($arrProductImg);

                $input = $request->all();

                $product->update($input);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back()->withErrors(["message" => "An error occurred while updating the product."]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(["message" => "An unexpected error occurred."]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);

            $image_ids = $product->images->pluck('file_id')->toArray();

            if (!empty($image_ids)) {
                ProductImage::where('product_id', $id)->delete();
                File::whereIn('id', $image_ids)->delete();
            }

            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.products.index')
                    ->with('error', 'Cannot delete the product. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
