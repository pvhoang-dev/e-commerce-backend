@extends('web.layouts.layout')

@section('content')
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-10 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Shopping Cart
            </span>
        </div>
    </div>

    {{--<!-- Shoping Cart -->--}}
    {{--@if ($items->isEmpty())--}}
        {{--<div class="text-center" style="height: 50vh">--}}
            {{--<p class="mt-5 h6">Your cart is currently empty.</p>--}}
            {{--<a href="{{ route('home.show') }}" class="btn btn-info btn-lg mt-5 h4">--}}
                {{--<span>Return to shop</span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--@else--}}
        <form class="bg0 p-t-25 p-b-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5">Total</th>
                                    </tr>

                                    <tr class="table_row cart_item" data-id="">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ route('file.show', 3) }}"
                                                     alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">thộn</td>
                                        <td class="column-3">1 tỷ</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                       name="num-product1" value="10">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">11111</td>
                                    </tr>

                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                           name="coupon" placeholder="Coupon Code">

                                    <div
                                            class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Apply coupon
                                    </div>
                                </div>

                                <button id="update-cart" type="button" name="update_cart"
                                        class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Update Cart
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Subtotal:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        11111 đ
                                    </span>
                                </div>
                            </div>

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
                                    <span class="stext-110 cl2">
                                        Shipping:
                                    </span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <div>
                                            <p class="stext-111 cl6 p-t-2">
                                                Shopping to
                                                <strong
                                                        class="address-detail">thôn Nam Khánh, xã Mỹ Thuận, huyện Mỹ Lộc, tỉnh Nam Định</strong>
                                            </p>
                                            <p class="stext-111 cl6 p-t-2 address-content" hidden>
                                                Shopping to
                                                <strong class="address-detail"></strong>
                                            </p>
                                        <div class="p-t-15">
                                            <span class="stext-112 cl8">
                                                New Address
                                            </span>
                                            <div class="form-group city p-t-10">
                                                <select name="cart_city" id="select-city"
                                                        class="form-control select-city"
                                                        data-placeholder="Select a city">
                                                    <option>Select a city</option>
                                                </select>
                                            </div>

                                            <div class="form-group district">
                                                <select name="cart_district" id="select-district"
                                                        class="form-control select-district"
                                                        data-placeholder="Select a district">
                                                    <option>Select a district</option>
                                                </select>
                                            </div>

                                            <div class="form-group ward">
                                                <select name="cart_ward" id="select-ward"
                                                        class="form-control select-ward"
                                                        data-placeholder="Select a ward">
                                                    <option>Select a ward</option>
                                                </select>
                                            </div>

                                            <div class="bg0 m-b-22">
                                                <input class="select form-control" name="cart_street" id="cart_street"
                                                       placeholder="Street address" value=""/>
                                            </div>

                                            <div class="flex-w">
                                                <div id="update-address"
                                                     class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                                    Update Address
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        1 tỷ đ
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.show') }}"
                               class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection


