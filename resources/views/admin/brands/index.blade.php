@extends('admin.layouts.master')

@section('title')
    List Brand

    <a href="{{ route('admin.brands.create') }}" class="btn btn-outline-primary ml-2">
        Add
    </a>

    <form action="{{ route('admin.brands.index') }}" method="GET" class="ml-auto">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" value="{{ $search }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
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
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->name }}</td>
                                    <td style="max-width: 20px">
                                        @if ($brand->file_id)
                                            <img class="rounded mr-1 mb-3 mb-sm-0 img-fluid"
                                                src="{{ route('file.show', $brand->file_id) }}" alt="">
                                        @else
                                            none
                                        @endif
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
        <div class="card-footer clearfix">
            {{ $brands->appends(request()->query())->links('admin.pagination.custom') }}
        </div>
    </div>
@endsection
