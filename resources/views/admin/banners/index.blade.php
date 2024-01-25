@extends('admin.layouts.master')

@section('title')
    List Banner

    <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-primary ml-2">
        Add
    </a>

    <form action="{{ route('admin.banners.index') }}" method="GET" class="ml-auto">
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
                @if ($banners->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <td>Slug</td>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Url</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->title }}</td>
                                    <td>{{ $banner->slug }}</td>
                                    <td style="max-width: 20px"><img
                                            src="{{ route('file.show', ['file_id' => $banner->file_id]) }}" alt="">
                                    </td>
                                    <td>{{ $banner->position }}</td>
                                    <td>{{ $banner->url ?? 'none' }}</td>
                                    <td>
                                        <form action="{{ route('admin.banners.delete', $banner->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class='btn-group'>
                                                <a class="action-icon"
                                                    href="{{ route('admin.banners.edit', ['id' => $banner->id]) }}">
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
            {{ $banners->appends(request()->query())->links('admin.pagination.custom') }}
        </div>
    </div>
@endsection
