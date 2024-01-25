@extends('admin.layouts.master')

@section('title')
    Edit Product Variant
    <a href="{{ route('admin.products.edit', $productVariant->product_id) }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.product_variants.update', ['id' => $productVariant->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="product_id">Product Parent</label>
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                        <input type="text" disabled value="{{ $product->name }}" id="product_id" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $productVariant->name }}" name="name" id="name"
                            class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="price">Price</label>
                        <input type="number" value="{{ $productVariant->price }}" name="price" id="price"
                            class="form-control">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" value="{{ $productVariant->qty }}" name="qty" id="qty"
                            class="form-control">
                        @if ($errors->has('qty'))
                            <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-12"></div>

                    @if (isset($productVariant->productAttributeValue))
                        @foreach ($productVariant->productAttributeValue as $attrValue)
                            <div class="form-group col-sm-6">
                                <label>{{ $attrValue->attributeValue->attribute->name }}:</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $attrValue->attributeValue->value }}">
                            </div>
                        @endforeach
                    @endif
                    @if($productImages->count())
                        <div class="m-2 row">
                            <h4 class="mb-3 col-12">Select Product Variant Image</h4>
                            @foreach ($productImages as $image)
                                <div class="col-md-3 col-sm-6 col-12 img-{{ $image->file_id }}">
                                    <div class="card ribbon-box">
                                        <div class="card-body border rounded">
                                            <div data-id="{{ $image->file_id }}" role="button" class="deleteImg ribbon ribbon-secondary float-right">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="file_id" @if($productVariant->file_id == $image->file_id) checked @endif id="option-{{ $image->file_id }}" value="{{ $image->file_id }}">
                                                    <label class="custom-control-label" for="option-{{ $image->file_id }}"></label>
                                                </div>
                                            </div>
                                            <div class="ribbon-content">
                                                <a href="{{ route('file.show', $image->file_id) }}" target="_blank">
                                                    <img src="{{ route('file.show', $image->file_id) }}" alt="post-img"
                                                         class="rounded mr-1 mb-3 mb-sm-0 img-fluid">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="card ribbon-box">
                                    <div class="card-body border rounded">
                                        <div data-id="0" role="button" class="deleteImg ribbon ribbon-warning float-right">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" name="file_id" @if($productVariant->file_id == null) checked @endif id="option-0" value="0">
                                                <label class="custom-control-label" for="option-0">NULL</label>
                                            </div>
                                        </div>
                                        <div class="ribbon-content">
                                            <img src="{{ asset('images/default/default_image.png') }}" alt="post-img"
                                                 class="rounded mr-1 mb-3 mb-sm-0 img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer w-100 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" id="create">Save</button>
            </div>
        </form>
    </div>

    <div class="card">
        <form action="{{ route('admin.product_variants.update_discount', ['id' => $productVariant->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <h4 class="mb-3">Discount</h4>
                <hr>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="status">Status</label>
                        <div>
                            <input class="updateStatus" type="checkbox" id="product-status"
                                   name="status"
                                   @if ($productPromotion?->status == 1) checked @endif
                                   data-switch="success"
                            />
                            <label for="product-status" data-on-label="On" data-off-label="Off"
                                   class="mb-0 d-block"></label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="discount_percent">Discount percent</label>
                        <input type="number" value="{{ $productPromotion?->discount_percent }}" name="discount_percent" id="discount_percent"
                               class="form-control">
                        @if ($errors->has('discount_percent'))
                            <span class="text-danger">{{ $errors->first('discount_percent') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="start_date">Start date</label>
                        <input type="text" value="{{ $productPromotion?->start_date }}" name="start_date" id="start_date"
                               class="form-control">
                        @if ($errors->has('start_date'))
                            <span class="text-danger">{{ $errors->first('start_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="end_date">End date</label>
                        <input type="text" value="{{ $productPromotion?->end_date }}" name="end_date" id="end_date"
                               class="form-control">
                        @if ($errors->has('end_date'))
                            <span class="text-danger">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="float-right mt-2 mb-3">
                    <button type="submit" class="btn btn-primary" id="create">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
