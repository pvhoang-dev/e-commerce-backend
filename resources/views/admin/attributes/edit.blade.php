@extends('admin.layouts.master')

@section('title')
    Edit Attribute

    <a href="{{ route('admin.attributes.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.attributes.update', ['id' => $attribute-> id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <label for="attr_name">Name</label>
                        <input type="text" value="{{$attribute -> name}}" name="name" id="attr_name" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
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
