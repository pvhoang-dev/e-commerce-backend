<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageProduct;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

class HomePageController extends Controller
{
    public function addHomePage(Request $request)
    {
        $input = $request->all();
        $input['status'] = 1;

        $product = HomePageProduct::query();

        $maxProductsPerGroup = 4;

        $existingProduct = $product->where('product_id', $input['product_id'])->first();

        $groupProductsCount = $product->where('group', $input['group'])->count();

        if ($groupProductsCount >= $maxProductsPerGroup) {
            return redirect()->back()->with('error' , 'Group đã đủ số lượng sản phẩm.');
        }

        if ($existingProduct) {
            return redirect()->back()->with('error', 'Sản phẩm đã tồn tại trong homepage');
        }

        HomePageProduct::create($input);

        return redirect()->back()->with('success', 'Thêm sản phẩm thành công vào homepage');
    }

}
