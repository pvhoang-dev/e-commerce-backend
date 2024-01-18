@extends('admin.layouts.master')

@section('title')
    Edit Attribute Value

    <a href="{{ route('admin.attribute_values.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.attribute_values.update', ['id' => $attributeValue->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="attr_id">Attribute</label>
                        <select class="form-control select2" name="attribute_id" id="attr_id" data-toggle="select2">
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}"
                                    {{ $attribute->id == $attributeValue->attribute_id ? 'selected' : '' }}>
                                    {{ $attribute->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="attr_value">Value</label>
                        <input type="text" value="{{ $attributeValue->value }}" name="value" id="attr_value"
                            class="form-control">
                        @if ($errors->has('value'))
                            <span class="text-danger">{{ $errors->first('value') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer float-right border-0 bg-transparent">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
