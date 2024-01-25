@extends('admin.layouts.master')

@section('title')
    All Products

    <a class="btn btn-primary float-right align-items-center" href="{{ route('admin.products.create') }}">
        Add New
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                <table class="table table-centered mb-0 " id="products-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell">Qty</th>
                            <th class="d-none d-sm-table-cell">Price</th>
                            <th class="d-none d-lg-table-cell">Category</th>
                            <th class="d-none d-lg-table-cell">Brand</th>
                            <th>Status</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td style="max-width: 20px">
                                    @if ($product->images->count())
                                        <img class="rounded mr-1 mb-3 mb-sm-0 img-fluid"
                                            src="{{ route('file.show', $product->images[0]->file_id) }}" alt="">
                                    @else
                                        Chưa có ảnh
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td class="d-none d-sm-table-cell">
                                    <h4><span class="badge badge-primary">{{ $product->qty }}</span></h4>
                                </td>
                                <td class="d-none d-lg-table-cell">{{ $product->price }}</td>
                                <td class="d-none d-lg-table-cell">{{ $product->category->name }}</td>
                                <td class="d-none d-lg-table-cell">{{ $product->brand->name }}</td>
                                <td>
                                    <div>
                                        <input class="updateStatus" type="checkbox" id="product-{{ $product->id }}"
                                            object="products" object_id="{{ $product->id }}"
                                            status="{{ $product->status }}" @if ($product->status == 1) checked @endif
                                            data-switch="success"
                                            disabled
                                        />
                                        <label for="product-{{ $product->id }}" data-on-label="" data-off-label=""
                                            class="mb-0 d-block"></label>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.products.edit', [$product->id]) }}"
                                                class="action-icon">
                                                <i class="mdi mdi-pencil"></i></a>
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
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ ($products->links('admin.pagination.custom')) }}
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
