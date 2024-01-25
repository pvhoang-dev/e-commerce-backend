@extends('web.layouts.layout')

@push('css')
@endpush

@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="product.html" class="stext-109 cl8 hov-cl1 trans-04">
                Men
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Lightweight Jacket
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @php
                                    // dd($product->images);
                                @endphp
                                @foreach ($product->images as $value)
                                    @php
                                        // dd(route('file.show', ['file_id' => $value->file_id ?? 100000]));
                                    @endphp
                                    <div class="item-slick3"
                                        data-thumb="{{ route('file.show', ['file_id' => $value->file_id ?? 100000]) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ route('file.show', ['file_id' => $value->file_id ?? ($product->img_is_default ?? 0)]) }}"
                                                alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ route('file.show', ['file_id' => $value->file_id ?? 100000]) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h4>

                        <span class="mtext-106 cl2">
                            {{ number_format($product->price) }}
                        </span>

                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->short_desc ?? '' }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            @php
                                $aryAttr1 = []; // store all attr1 value
                                $hasAttr2 = false; // check has Attr2
                                $i = 0;
                            @endphp
                            <div class="flex-w flex-r-m p-b-10">
                                @foreach ($productVariants as $key => $variant)
                                    @php
                                        $attrValue = current($variant)['attr_value'];

                                        $attrName1 = current($variant)['attr_name'];
                                    @endphp

                                    @if ($i == 0)
                                        <div class="size-203 respon6">
                                            {{ $attrName1 }}
                                        </div>
                                        @php
                                            // get attr2 name
                                            $attrName2 = last($variant)['attr_name'];

                                            if ($attrName1 !== $attrName2) {
                                                $hasAttr2 = true;
                                            }

                                            $i++; // break if
                                        @endphp

                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bg0">
                                                <select id="{{ $attrName1 }}"
                                                    class="form-control @if ($hasAttr2 == false) product_variant_option @else attribute_group_name @endif {{ \Illuminate\Support\Str::slug($attrName1) }}"
                                                    {{-- name="time" --}}
                                                    name="attribute_{{ \Illuminate\Support\Str::slug($attrName1) }}"
                                                    data-attribute_name="attribute_{{ \Illuminate\Support\Str::slug($attrName1) }}"
                                                    data-show_option_none="yes">
                                    @endif

                                    @if (!in_array($attrValue, $aryAttr1))
                                        <option class="" id="{{ \Illuminate\Support\Str::slug($attrValue) }}"
                                            value="{{ $attrValue }}"
                                            data-name="{{ \Illuminate\Support\Str::slug($attrValue) }}"
                                            @if ($hasAttr2 == false) data-product-variant-id="{{ $key }} @endif">
                                            {{ $attrValue }}
                                        </option>

                                        @php
                                            $aryAttr1[] = $attrValue; // push attr value
                                        @endphp
                                    @endif
                                @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Attribute 2 --}}
                    @if ($hasAttr2 == true)
                        @php
                            $aryAttr2 = []; // store all attr2 value
                        @endphp
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 respon6">
                                {{ $attrName2 }}
                            </div>

                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bg0">
                                    <select id="{{ $attrName2 }}"
                                        class="form-control product_variant_option {{ \Illuminate\Support\Str::slug($attrName2) }}"
                                        data-attribute_name="attribute_{{ \Illuminate\Support\Str::slug($attrName2) }}"
                                        data-show_option_none="yes" {{-- name="time" --}}
                                        name="attribute_{{ \Illuminate\Support\Str::slug($attrName2) }}">

                                        @foreach ($productVariants as $key => $variant)
                                            @php
                                                $attrValue = last($variant)['attr_value'];
                                            @endphp

                                            <option
                                                id="{{ \Illuminate\Support\Str::slug(current($variant)['attr_value']) }}-{{ \Illuminate\Support\Str::slug($attrValue) }}"
                                                value="{{ $attrValue }}" class="d-none"
                                                data-option-value="{{ \Illuminate\Support\Str::slug($attrValue) }}"
                                                data-name="{{ \Illuminate\Support\Str::slug(current($variant)['attr_value']) }}"
                                                data-product-variant-id="{{ $key }}">
                                                {{ $attrValue }}
                                            </option>

                                            @php
                                                if (!in_array($attrValue, $aryAttr2)) {
                                                    $aryAttr2[] = $attrValue;
                                                }
                                            @endphp
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-204 flex-w flex-m respon6-next">
                            <button id="btn-add-to-card"
                                class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>

                <!--  -->
                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                    <div class="flex-m bor9 p-r-10 m-r-11">
                        <a href="#"
                            class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                            data-tooltip="Add to Wishlist">
                            <i class="zmdi zmdi-favorite"></i>
                        </a>
                    </div>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                        data-tooltip="Google Plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>

                    <li class="nav-item p-b-10">
                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional
                            information</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {!! $product->description?->description !!}
                            </p>
                        </div>
                    </div>

                    <!-- - -->
                    <div class="tab-pane fade" id="information" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                <ul class="p-lr-28 p-lr-15-sm">
                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Weight
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            ...
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Materials
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            60% cotton
                                        </span>
                                    </li>

                                    <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            {{ $attrName1 ?? '' }}
                                        </span>

                                        <span class="stext-102 cl6 size-206">
                                            {{ implode(', ', $aryAttr1) }}
                                        </span>
                                    </li>

                                    @if ($hasAttr2)
                                        <li class="flex-w flex-t p-b-7">
                                            <span class="stext-102 cl3 size-205">
                                                {{ $attrName2 }}
                                            </span>

                                            <span class="stext-102 cl6 size-206">
                                                {{ implode(', ', $aryAttr2) }}
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: {{ $product->sku }}
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Categories: {{ $product->category->name }}
            </span>
        </div>
    </section>


    <!-- Related Products -->
    @if (!$categoryProducts->isEmpty())
        <section class="sec-relate-product bg0 p-t-45 p-b-105">
            <div class="container">
                <div class="p-b-45">
                    <h3 class="ltext-106 cl5 txt-center">
                        You may also like…
                    </h3>
                </div>

                <!-- Slide2 -->
                <div class="wrap-slick2">
                    <div class="slick2">
                        @foreach ($categoryProducts as $cateProduct)
                            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        @if ($cateProduct->images->first())
                                            <img src="{{ route('file.show', $cateProduct->images[0]->file_id) }}"
                                                alt="IMG-PRODUCT">
                                        @else
                                            <img src="{{ asset('images/default/default_image.png') }}"
                                                alt="DEFAULT-PRODUCT">
                                        @endif

                                        <a href="{{ route('detail.show', $cateProduct->id) }}"
                                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                            Quick View
                                        </a>
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="{{ route('detail.show', $cateProduct->id) }}"
                                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $cateProduct->name }}
                                            </a>

                                            <span class="stext-105 cl3">
                                                {{ number_format($cateProduct->price) }}
                                            </span>
                                        </div>

                                        <div class="block2-txt-child2 flex-r p-t-3">
                                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                <img class="icon-heart1 dis-block trans-04"
                                                    src="{{ asset('web/images/icons/icon-heart-01.png') }}"
                                                    alt="ICON">
                                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                    src="{{ asset('web/images/icons/icon-heart-02.png') }}"
                                                    alt="ICON">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Select attr
            if ($(".attribute_group_name option:selected")) {

                let id = $(".attribute_group_name option:selected").attr('id');

                $(`.product_variant_option option[data-name="${id}"]`).removeClass('d-none');
            }

            $(".attribute_group_name").change(function() {
                $(".product_variant_option option").addClass('d-none');

                $(".product_variant_option option").removeAttr("selected");

                let id = $(".attribute_group_name option:selected").attr('id');

                $(`.product_variant_option option[data-name="${id}"]`).removeClass('d-none');

                $(`.product_variant_option option[data-name="${id}"]`).first().attr('selected', 'selected');
            });

            $(document).on('click', '#btn-add-to-card', function() {
                var product_variant_id = $(".product_variant_option option:selected").attr(
                    'data-product-variant-id');
                var qty = $('#quantity-item').val();

                var option_2 = $(".product_variant_option option:selected").attr(
                    'data-option-value');

                var option_1 = $(".attribute_group_name   option:selected").attr(
                    'data-name');
                
                    console.log(option_1, option_2);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: '{{ route('cart.add') }}',
                    data: {
                        id: product_variant_id,
                        qty: qty,
                        option_1:option_1,
                        option_2:option_2
                    },
                    success: function(resp) {
                        $.toast({
                            heading: 'Success',
                            text: resp['message'],
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        })
                        setTimeout(
                            function() {
                                location.reload();
                            }, 500);
                    },
                    error: function() {
                        $.toast({
                            heading: 'Error',
                            text: 'Item added failed',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'error'
                        })
                    }
                })
            });

        })
    </script>
@endpush
