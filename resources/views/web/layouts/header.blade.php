<!-- Header -->
<?php
$cart = session('cart.items');
$total = $qty = 0;
?>
@if (isset($cart))
    @foreach ($cart as $item)
        @php
            $total += $item['price'] * $item['quantity'];
            $qty += $item['quantity'];
        @endphp
    @endforeach
@endif
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        EN
                    </a>

                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        USD
                    </a>
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('home.show') }}" class="logo">
                    <img src="{{ asset('web/images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="#">Menu</a>
                            <ul class="sub-menu">
                                @foreach ($menus as $menu)
                                    <li class="">
                                        <a href="#">{{ $menu['name'] }}</a>
                                        @if (!empty($menu['sub_menus']))
                                            <ul class="sub-menu">
                                                @foreach ($menu['sub_menus'] as $subMenu)
                                                    <li class="">
                                                        <a href="#">{{ $subMenu['name'] }}</a>
                                                        @if (!empty($subMenu['sub_menus']))
                                                            <ul class="sub-menu">
                                                                @foreach ($subMenu['sub_menus'] as $subSubMenu)
                                                                    <li>
                                                                        <a href="#">{{ $subSubMenu['name'] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                {{-- <li class="main-menu">
                                    <a href="#">Menu 1</a>
                                    <ul class="sub-menu">
                                        <li class="main-menu">
                                            <a href="#">SubMenu 1</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">SubSubMenu 1</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">SubMenu 2</a>
                                        </li>
                                        <li>
                                            <a href="#">SubMenu 3</a>
                                        </li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </li>
                        <li>
                            <a href="">Shop</a>
                            <ul class="sub-menu">
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                    @if ($category->subCategory->count())
                                        @foreach ($category->subCategory as $categoryChildrent)
                                            <li style="padding-left: 15px;">
                                                <a href=""> {{ $categoryChildrent->name }} </a>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                            <span class="arrow-main-menu-m">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>
                        </li>

                        <li>
                            <a href="">Blog</a>
                        </li>

                        <li>
                            <a href="">About</a>
                        </li>

                        <li>
                            <a href="">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="1">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ route('home.show') }}"><img src="{{ asset('web/images/icons/logo-01.png') }}"
                    alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        My Account
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        EN
                    </a>

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        USD
                    </a>
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="{{ route('home.show') }}">Home</a>
            </li>

            <li>
                <a href="">Shop</a>
                <ul class="sub-menu-m">
                    @foreach ($categories as $category)
                        <li>
                            <a href="">
                                {{ $category->name }}
                            </a>
                        </li>
                        @if ($category->subCategory->count())
                            @foreach ($category->subCategory as $categoryChildrent)
                                <li style="padding-left: 15px;">
                                    <a href=""> {{ $categoryChildrent->name }} </a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="blog.html">Blog</a>
            </li>

            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('web/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>

<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        <div class="header-cart-content flex-w js-pscroll w-full">
            <ul class="header-cart-wrapitem w-full">
                @if (isset($cart))
                    @foreach ($cart as $item)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{route('file.show', $item['image'])}}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                   {{$item['name']}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{$item['quantity']}} x {{$item['price']}}đ
                                </span>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>
        </div>
        <div class="w-full">
            <div class="header-cart-total w-full p-tb-40">
                Total: 1 tyr` đ
            </div>

            <div class="header-cart-buttons flex-w w-full">
                <a href="{{ route('cart.show') }}"
                    class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                    View Cart
                </a>

                <a href="{{ route('checkout.show') }}"
                    class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                    Check Out
                </a>
            </div>
        </div>
    </div>
</div>

<script></script>
