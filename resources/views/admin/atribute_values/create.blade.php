@extends('admin.layouts.master')

@section('title')
    Add Attribute Value

    <a href="{{ route('admin.attribute_values.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('admin.attribute_values.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="attr_id">Attribute</label>
                        <select class="form-control select2" name="attribute_id" id="attr_id" data-toggle="select2">
                            @foreach ($attributes as $attribute)
                                <option value="{{$attribute -> id}}">{{$attribute -> name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('attribute_id'))
                            <span class="text-danger">{{ $errors->first('attribute_id') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="attr_value">Value</label>
                        <input type="text" name="value" id="attr_value" class="form-control">
                        @if ($errors->has('value'))
                            <span class="text-danger">{{ $errors->first('value') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer float-right border-0 bg-transparent">
                <button type="submit" class="btn btn-primary" id="create">Create</button>
            </div>
        </form>
    </div>
@endsection
