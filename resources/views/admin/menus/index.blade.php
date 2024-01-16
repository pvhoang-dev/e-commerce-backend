@extends('admin.layouts.master')

@section('title')
    List Menus

    <a href="{{ route('admin.menus.create') }}" class="btn btn-outline-info float-right">
        Add Menu
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($menus->count())
                    <table class="table table-centered mb-0 " id="attributes-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Parent</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->position }}</td>
                                <td>{{ $menu -> parent_id != 0 ? $menu->parentMenu -> name : 'Parent'}}</td>
                                <td>{{ $menu->url ?? '/'}}</td>
                                <td>
                                    <form action="{{ route('admin.menus.delete', $menu->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class='btn-group'>
                                            <a class="action-icon"
                                               href="{{ route('admin.menus.edit', ['id' => $menu->id]) }}">
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
@push('js')
    <script>
        // Blade syntax to check if the 'error' session variable is present
        @if(session('error'))
        // Display an alert with the error message
        alert("{{ session('error') }}");
        @endif
    </script>
@endpush
