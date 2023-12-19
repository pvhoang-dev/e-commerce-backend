@extends('admin.layouts.master')

@section('title')
    List Attribute

    <a href="{{ route('admin.attributes.create') }}" class="btn btn-outline-info float-right">
        Add Attribute
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($attributes->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $attribute)
                            <tr>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->code }}</td>
                                <td>
                                    <div class='btn-group'>
                                        <a class="action-icon"
                                            href="{{ route('admin.attributes.show', ['id' => $attribute->id]) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a class="action-icon delete"
                                            href="{{ route('admin.attributes.delete', ['id' => $attribute->id]) }}">
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
