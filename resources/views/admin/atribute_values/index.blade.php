@extends('admin.layouts.master')

@section('title')
    List Attribute Value

    <a href="{{ route('admin.attribute_values.create') }}" class="btn btn-outline-info float-right">
        Add Attribute Value
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($attributeValues->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                    <thead>
                        <tr>
                            <th>Attribute Name</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributeValues as $value)
                            <tr>
                                <td>{{ $value->attribute->name }}</td>
                                <td>{{ $value->value }}</td>
                                <td>
                                    <div class='btn-group'>
                                        <a class="action-icon"
                                            href="{{ route('admin.attribute_values.show', ['id' => $value->id]) }}">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a class="action-icon delete"
                                            href="{{ route('admin.attribute_values.delete', ['id' => $value->id]) }}">
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
