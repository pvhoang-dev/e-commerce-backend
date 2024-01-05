@extends('admin.layouts.master')

@section('title')
    Add Product Variant
    <a href="{{ route('admin.products.edit', request()->product_id) }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        <form action="{{route('admin.product_variants.store')}}" method="post">
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
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_1">Plv 1</label>
                        <input type="number" name="plv_1" id="plv_1" class="form-control" value="{{ old('plv_1') }}">
                        @if ($errors->has('plv_1'))
                            <span class="text-danger">{{ $errors->first('plv_1') }}</span>
                        @endif
                    </div>

                     <div class="form-group col-sm-6">
                        <label for="plv_2">Plv 2</label>
                        <input type="number" name="plv_2" id="plv_2" class="form-control" value="{{ old('plv_2') }}">
                         @if ($errors->has('plv_2'))
                             <span class="text-danger">{{ $errors->first('plv_2') }}</span>
                         @endif
                    </div>

                     <div class="form-group col-sm-6">
                        <label for="plv_3">Plv 3</label>
                        <input type="number" name="plv_3" id="plv_3" class="form-control" value="{{ old('plv_3') }}">
                         @if ($errors->has('plv_3'))
                             <span class="text-danger">{{ $errors->first('plv_3') }}</span>
                         @endif
                    </div>
                    <div class="form-group col-sm-6">
                         <label for="qty">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty') }}">
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
                                        <input disabled class="form-control" value="{{ $attribute->name }}" />
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
                                        <input disabled class="form-control" value="{{ $attribute->name }}" />
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

                </div>
            </div>
             <div class="card-footer float-right">
                 <button type="submit" class="btn btn-primary" id="create">Create</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#attribute_1").on("change", function(e) {
                $.ajax({
                    url: '{{ route('admin.ajaxGetAttributeValue') }}?attribute_id=' + $(this)
                        .val(),
                }).done(function(data) {
                    console.log(data)
                    $("#attribute_1_value").html(data)
                });
            })

            $("#attribute_2").on("change", function(e) {
                $.ajax({
                    url: '{{ route('admin.ajaxGetAttributeValue') }}?attribute_id=' + $(this)
                        .val(),
                }).done(function(data) {
                    $("#attribute_2_value").html(data)
                });
            })
        });
    </script>
@endpush
