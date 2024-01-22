@extends('admin.layouts.master')

@section('title')
    Add Product Variant
    <a href="{{ route('admin.products.edit', request()->product_id) }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.product_variants.store') }}" method="post">
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
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                               value="{{ old('price') }}">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control"
                               value="{{ old('qty') }}">
                        @if ($errors->has('qty'))
                            <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-12"></div>

                    {{-- Create Product Variant --}}
                    @if (empty($variantAttribute))
                        @if (isset($attributes))
                            <div class="form-group col-sm-6" id="option-1">
                                <label>Attribute 1: <span class="index-1"></span></label>
                                <select class="form-control" id="attribute_1" name="attribute_id_1">
                                    <option value="0">No Select</option>
                                    @foreach ($attributes as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6" id="option-2">
                                <label>Attribute 1 Value: <span class="index-1"></span></label>
                                <select class="form-control" id="attribute_1_value" name="attribute_value_id_1">
                                </select>
                            </div>
                            <div class="form-group col-sm-6" id="option-1">
                                <label>Attribute 2: <span class="index-1"></span></label>
                                <select class="form-control" id="attribute_2" name="attribute_id_2">
                                    <option value="0">No Select</option>
                                    @foreach ($attributes as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6" id="option-2">
                                <label>Attribute 2 Value: <span class="index-1"></span></label>
                                <select class="form-control" id="attribute_2_value" name="attribute_value_id_2">
                                </select>
                            </div>
                        @endif
                    @else
                        @if (isset($variantAttribute[0]))
                            <div class="col-sm-6 form-group">
                                <input type="hidden" name="attribute_id_1" value="{{ $variantAttribute[0] }}">
                                @foreach ($attributes as $attribute)
                                    @if ($attribute->id == $variantAttribute[0])
                                        <label>Attribute 1: <span class="index-1"></span></label>
                                        <input disabled class="form-control" value="{{ $attribute->name }}"/>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-sm-6">
                                <label>Attribute 1 Value: <span class="index-1"></span></label>
                                <select name="attribute_value_id_1" class="form-control">
                                    @foreach ($variantAttributeValue as $value)
                                        @if ($value->attribute_id == $variantAttribute[0])
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if (isset($variantAttribute[1]))
                            <div class="col-sm-6 form-group">
                                <input type="hidden" name="attribute_id_2" value="{{ $variantAttribute[1] }}">
                                @foreach ($attributes as $attribute)
                                    @if ($attribute->id == $variantAttribute[1])
                                        <label>Attribute 2: <span class="index-1"></span></label>
                                        <input disabled class="form-control" value="{{ $attribute->name }}"/>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-sm-6">
                                <label>Attribute 2 Value: <span class="index-1"></span></label>
                                <select name="attribute_value_id_2" class="form-control">
                                    @foreach ($variantAttributeValue as $value)
                                        @if ($value->attribute_id == $variantAttribute[1])
                                            <option value="{{ $value->id }}">{{ $value->value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
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
                                                    <input class="custom-control-input" type="radio" name="file_id" id="option-{{ $image->file_id }}" value="{{ $image->file_id }}">
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
                                                <input class="custom-control-input" type="radio" name="file_id" checked id="option-0" value="0">
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
                <button type="submit" class="btn btn-primary" id="create">Create</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#attribute_1").on("change", function (e) {
                $.ajax({
                    url: '{{ route('admin.ajaxGetAttributeValue') }}?attribute_id=' + $(this)
                        .val(),
                }).done(function (data) {
                    console.log(data)
                    $("#attribute_1_value").html(data)
                });
            })

            $("#attribute_2").on("change", function (e) {
                $.ajax({
                    url: '{{ route('admin.ajaxGetAttributeValue') }}?attribute_id=' + $(this)
                        .val(),
                }).done(function (data) {
                    $("#attribute_2_value").html(data)
                });
            })
        });
    </script>
@endpush
