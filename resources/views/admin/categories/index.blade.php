@extends('admin.layouts.master')

@section('title')
    List Category

    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-info float-right">
        Add Category
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($categories->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->position }}</td>
                                    <td>{{ $category -> parent_id != 0 ? $category->parentCategory -> name : 'Parent'}}</td>
                                    <td>
                                        <div class='btn-group'>
                                            <a class="action-icon"
                                                href="{{ route('admin.categories.show', ['id' => $category->id]) }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a class="action-icon delete"
                                                href="{{ route('admin.categories.delete', ['id' => $category->id]) }}">
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
