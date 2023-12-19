@extends('admin.layouts.master')

@section('title')
    List Banner

    <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-info float-right">
        Add Banner
    </a>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{$banner -> title}}</td>
                                <td>{{$banner -> slug}}</td>
                                <td><img width="200" src="{{route('file.show', ['file_id' => $banner -> file_id])}}" alt=""></td>
                                <td>{{$banner -> position}}</td>
                                <td>
                                    <div class='btn-group'>
                                        <a class="action-icon"
                                           href="{{ route('admin.banners.show', ['id' => $banner->id]) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a class="action-icon delete"
                                           href="{{ route('admin.banners.delete', ['id' => $banner->id]) }}">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </div>
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
