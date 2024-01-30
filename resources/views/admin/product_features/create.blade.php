@extends('admin.layouts.master')

@section('title')
    Add Feature Category

    <a href="{{ route('admin.feature_categories.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.feature_categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="position">Position</label>
                        <input type="number" name="position" id="position" class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
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
