<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $userId = 1; // Not login

    public function index()
    {
        // \Cart::session($this->userId)->clear();
//         \Cart::session('address')->clear();

        $data = \Cart::session($this->userId)->getContent();

        $address = \Cart::session('address')->getContent();

        return view('web.checkout', [
            'data' => $data,
            'address' => $address
        ]);
    }
}
