@extends('admin.layouts.master')

@section('title')
    Locations

    <form action="{{ route('admin.locations.create') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-outline-info float-right"
                onclick="return confirm('Are you sure?')">
            Create
        </button>
    </form>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
