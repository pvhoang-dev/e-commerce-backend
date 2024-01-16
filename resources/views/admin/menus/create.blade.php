@extends('admin.layouts.master')

@section('title')
    Add Menu

    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.menus.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="position">Position</label>
                        <input type="number" name="position" id="position" class="form-control"
                               value="{{ old('position') }}">
                        @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-12">
                        <label for="cate_parent">Menu Parent</label>
                        <select class="form-control select2" name="parent_id" id="cate_parent" data-toggle="select2">
                            <option value="0">Menu Parent</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu['id'] }}" {{ old('parent_id') == $menu['id'] ? 'selected' : ''}}>{{ $menu['name'] }}</option>
                                @if(!empty($menu['sub_menus']))
                                    @foreach($menu['sub_menus'] as $subMenu)
                                        <option value="{{$subMenu['id']}}">&nbsp;&nbsp;&nbsp;&#45;&#45;{{$subMenu['name']}}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-12">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}">
                        @if ($errors->has('url'))
                            <span class="text-danger">{{ $errors->first('url') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="class_name">Class name</label>
                        <input type="text" name="class_name" id="class_name" class="form-control"
                               value="{{ old('class_name') }}">
                        @if ($errors->has('class_name'))
                            <span class="text-danger">{{ $errors->first('class_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="id_name">Id name</label>
                        <input type="text" name="id_name" id="id_name" class="form-control"
                               value="{{ old('id_name') }}">
                        @if ($errors->has('id_name'))
                            <span class="text-danger">{{ $errors->first('id_name') }}</span>
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
@push('js')

@endpush
