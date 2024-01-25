@extends('admin.layouts.master')

@section('title')
    List Attribute

    <a href="{{ route('admin.attributes.create') }}" class="btn btn-outline-primary ml-2">
        Add
    </a>

    <form action="{{ route('admin.attributes.index') }}" method="GET" class="ml-auto">
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
                                        <form action="{{ route('admin.attributes.delete', $attribute->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class='btn-group'>
                                                <a class="action-icon"
                                                    href="{{ route('admin.attributes.edit', ['id' => $attribute->id]) }}">
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
            {{ $attributes->appends(request()->query())->links('admin.pagination.custom') }}
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
