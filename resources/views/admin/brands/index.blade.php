@extends('admin.layouts.master')

@section('title')
    List Brand

    <a href="{{ route('admin.brands.create') }}" class="btn btn-outline-info float-right">
        Add Brand
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($brands->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <td>Slug</td>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{$brand -> name}}</td>
                                <td>{{$brand -> slug}}</td>
                                <td><img width="200" src="{{route('file.show', ['file_id' => $brand -> file_id])}}" alt=""></td>
                                <td>
                                    <form action="{{ route('admin.brands.delete', $brand->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class='btn-group'>
                                            <a class="action-icon"
                                               href="{{ route('admin.brands.edit', ['id' => $brand->id]) }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <button type="submit" class="action-icon delete border-0 bg-transparent"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
