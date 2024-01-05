@extends('admin.layouts.master')

@section('title')
    Edit Product Variant
    <a href="{{ route('admin.products.edit', $productVariant->product_id) }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        <form action="{{route('admin.product_variants.update', ['id' => $productVariant->id])}}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="product_id">Product Parent</label>
                        <input type="hidden" value="{{$product -> id}}" name="product_id">
                        <input type="text" disabled value="{{$product -> name}}" id="product_id" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="name">Name</label>
                        <input type="text" value="{{$productVariant->name}}" name="name" id="name" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_1">Plv 1</label>
                        <input type="number" value="{{$productVariant->plv_1}}" name="plv_1" id="plv_1" class="form-control">
                        @if ($errors->has('plv_1'))
                            <span class="text-danger">{{ $errors->first('plv_1') }}</span>
                        @endif
                    </div>

                     <div class="form-group col-sm-6">
                        <label for="plv_2">Plv 2</label>
                        <input type="number" value="{{$productVariant->plv_2}}" name="plv_2" id="plv_2" class="form-control">
                         @if ($errors->has('plv_2'))
                             <span class="text-danger">{{ $errors->first('plv_2') }}</span>
                         @endif
                    </div>

                     <div class="form-group col-sm-6">
                        <label for="plv_3">Plv 3</label>
                        <input type="number" value="{{$productVariant->plv_3}}" name="plv_3" id="plv_3" class="form-control">
                         @if ($errors->has('plv_3'))
                             <span class="text-danger">{{ $errors->first('plv_3') }}</span>
                         @endif
                    </div>
                    <div class="form-group col-sm-6">
                         <label for="qty">Quantity</label>
                        <input type="number" value="{{$productVariant->qty}}" name="qty" id="qty" class="form-control">
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
                </div>
            </div>
             <div class="card-footer float-right">
                 <button type="submit" class="btn btn-primary" id="create">Save</button>
            </div>
        </form>
    </div>
@endsection
