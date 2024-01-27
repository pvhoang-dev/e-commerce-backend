<?php

namespace App\Http\Controllers\Admin;

use App\Enums\HomepageProductEnum;
use App\Enums\ProductTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Services\File\MakeFinalFileService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        Paginator::useBootstrap();

        $search = $request->input('search');

        $query = Product::query()->with(['images' => function ($query) {
            $query->where('type', 1);
        }]);

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(1);

        return view('admin.products.index', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();

        $brands = Brand::all();

        $types = ProductTypeEnum::getArrWithKey();

        return view('admin.products.create', [
            'categories' => $categories,
            'brands' => $brands,
            'types' => $types,
        ]);
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $product = Product::create($input);

        if ($request->has('file_id')) {
            self::uploadImages($request, $product->id, true);
        }
        return redirect()->route('admin.products.edit', [
            'id' => $product->id
        ]);
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

        $productVariants = ProductVariant::where('product_id', $product->id)->get();

        $categories = Category::get();

        $position = $categories->where('parent_id', 0)->pluck('position', 'name');

        $groups = HomepageProductEnum::getArrWithLowerKey();

        $brands = Brand::get();

        $types = ProductTypeEnum::getArrWithKey();

        return view('admin.products.edit', [
            'product' => $product,
            'productVariants' => $productVariants,
            'categories' => $categories,
            'brands' => $brands,
            'groups' => $groups,
            'position' => $position,
            'types' => $types,
        ]);
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            $input = $request->all();

            $product->update($input);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["message" => "An error occurred while updating the product."]);
        }

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

    /**
     * @param $file
     * @param $id
     * @param bool $create
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImages(Request $request, $id = null, $create = false)
    {
        if ($request->has('file_id')) {
            $arrProductImg = [];

            if ($create) {
                $productId = $id;
            } else {
                $productId = $request->id;
            }

            $product = Product::find($productId);

            $hasDefault = $product?->images->where('type', 1)->first();

            foreach ($request->get('file_id') as $file_id) {
                $response = MakeFinalFileService::convertDraftToFinal($file_id);

                if (!$response["status"]) {
                    return redirect()->back()->withErrors(["message" => "Upload file errors!"]);
                }

                $arrProductImg[] = [
                    'file_id' => $response["id"],
                    'position' => 0,
                    'product_id' => $productId,
                    'type' => 0,
                ];
            }

            if ($create || !$hasDefault) {
                $arrProductImg[0]['type'] = 1;
            }

            ProductImage::insert($arrProductImg);

            if (!$create) {
                return redirect()->back();
            }
        } else {
            return redirect()->back()->withErrors(["message" => "Empty images."]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        $id = $request->id;

        try {
            DB::beginTransaction();

            $file = File::find($id);

            $productImage = ProductImage::where('file_id', $id)->first();

            if($productImage->type == 1)
            {
                return response()->json(['success' => false, 'message' => "Do not delete the default image"]);
            }

            ProductVariant::where('file_id', $id)->update(['file_id' => 0]);

            $productImage->delete();

            $file->delete();

            unlink(storage_path("app/" . $file->path));

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setupPositionImages(Request $request)
    {
        if(!$request->has('defaultImage'))
        {
            return redirect()->back()->withErrors(["message" => "Choose default image!!!"]);
        }

        if($request->has('file'))
        {
            try {
                DB::beginTransaction();

                $positions = $request->get('file');

                $defaultImage = $request->get('defaultImage');

                $type = 0;

                foreach ($positions as $file_id => $position)
                {
                    if($defaultImage == $file_id)
                    {
                        $type = 1;
                    }

                    DB::table('product_images')
                        ->where('file_id', $file_id)
                        ->update([
                            'position' => $position,
                            'type' => $type
                        ]);

                    $type = 0;
                }

                DB::commit();

                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->withErrors(["message" => $e->getMessage()]);
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDescription(Request $request)
    {
        $input = $request->all();

        $description = ProductDescription::firstOrNew(['product_id' => $input['id']]);

        if (!$description->exists) {
            $description->product_id = $input['id'];
        }

        $description->description = $input['description'];

        $description->save();

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->get('status'))
        {
            if($product->productVariants->first() && $product->qty > 0){
                $product->update(['status' => 1]);
            } else {
                return redirect()->back()->withErrors(["message" => "Product does not have variants or quantity = 0"]);
            }
        } else {
            $product->update(['status' => 0]);
        }

        return redirect()->back();
    }
}
