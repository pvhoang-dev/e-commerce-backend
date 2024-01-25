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
                                        <form action="{{ route('admin.attribute_values.delete', $value->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class='btn-group'>
                                                <a class="action-icon"
                                                    href="{{ route('admin.attribute_values.edit', ['id' => $value->id]) }}">
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
            {{ ($attributeValues->links('admin.pagination.custom')) }}
        </div>
    </div>
@endsection
@push('js')
    <script>
        // Blade syntax to check if the 'error' session variable is present
        @if (session('error'))
            // Display an alert with the error message
            alert("{{ session('error') }}");
        @endif
    </script>
@endpush
