@extends('admin.layouts.master')

@section('title')
    Add Product
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="pro_name">Name</label>
                        <input type="text" value="{{ $product->name }}" name="name" id="pro_name"
                            class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" value="{{ $product->qty }}" name="qty" id="qty"
                            class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="category_id">Category</label>
                        <select class="form-control select2" name="category_id" id="category_id" data-toggle="select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_1">Plv_1</label>
                        <input type="number" value="{{ $product->plv_1 }}" name="plv_1" id="plv_1"
                            class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_2">Plv_2</label>
                        <input type="number" value="{{ $product->plv_2 }}" name="plv_2" id="plv_2"
                            class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_3">Plv_3</label>
                        <input type="number" value="{{ $product->plv_3 }}" name="plv_3" id="plv_3"
                            class="form-control">
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="short_desc">Description</label>
                        <input type="text" value="{{ $product->short_description }}" name="short_description"
                            id="short_desc" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <div class="dropzone">
                            <div class="dz-message needsclick">
                                <label for="uploadFile" style="cursor: pointer; display:block;">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h4>Drop files here or click to upload.</h4>
                                    <input type="file" id="uploadFile" multiple style="display: none">
                                </label>
                            </div>
                        </div>
                        <!-- Preview -->
                        <div class="dropzone-previews mt-3">
                            <div class="card mt-1 mb-0 shadow-none border dz-processing dz-error dz-complete">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer float-right">
                <button type="submit" class="btn btn-primary" id="create">Save</button>
            </div>
        </form>
    </div>

    @if ($product->images->count())
        <div class="row">
        @foreach ($product->images as $img)
            <div class="col">
                <img src="{{ route('file.show', $img->file_id) }}" alt="post-img"
                    class="rounded mr-1 mb-3 mb-sm-0 img-fluid">
            </div>
        @endforeach
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title d-flex justify-content-between align-items-center">
                    Product Variant
                    <a class="btn btn-primary float-right align-items-center"
                        href="{{ route('admin.product_variants.create', ['product_id' => $product->id]) }}">
                        Add New
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="card-body p-0">
                    <div class="table-responsive users-table">
                        <table class="table table-centered mb-0 " id="product-variants-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="d-none d-lg-table-cell">Slug</th>
                                    <th class="d-none d-sm-table-cell">Qty</th>
                                    <th class="d-none d-sm-table-cell">Plv 1</th>
                                    <th class="d-none d-sm-table-cell">Plv 2</th>
                                    <th class="d-none d-sm-table-cell">Plv 3</th>
                                    <th class="d-none d-lg-table-cell">Sku</th>
                                    <th>Status</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productVariants as $productVariant)
                                    <tr>
                                        <td>{{ $productVariant->name }}</td>
                                        <td class="d-none d-lg-table-cell">{{ $productVariant->slug }}</td>
                                        <td class="d-none d-sm-table-cell">
                                            <h4><span class="badge badge-primary">{{ $productVariant->qty }}</span>
                                            </h4>
                                        </td>
                                        <td class="d-none d-sm-table-cell">{{ $productVariant->plv_1 }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $productVariant->plv_2 }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $productVariant->plv_3 }}</td>
                                        <td class="d-none d-lg-table-cell">{{ $productVariant->sku }}</td>
                                        <td>
                                            <div>
                                                <input class="updateStatus" type="checkbox"
                                                    id="product-variants-{{ $productVariant->id }}"
                                                    object="product-variants" object_id="{{ $productVariant->id }}"
                                                    status="{{ $productVariant->status }}"
                                                    @if ($productVariant->status == 1) checked @endif
                                                    data-switch="success" />
                                                <label for="product-variants-{{ $productVariant->id }}"
                                                    data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class='btn-group'>
                                                <a href="{{ route('admin.product_variants.show', [$productVariant->id]) }}"
                                                    class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                <a class="action-icon delete"
                                                    href="{{ route('admin.product_variants.delete', ['id' => $product->id]) }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- <div class="card-footer clearfix">
                        <div class="float-right">
                            @include('adminlte-templates::common.paginate', [
                                'records' => $productVariants,
                            ])
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#uploadFile').change(function() {
            let formData = new FormData();

            let files = $(this)[0].files;

            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            let response = uploadFile(formData);
            console.log(response);

            if (response.status === 'success') {
                let files = response.data.files;

                let html = '';

                const listImages = $('.dropzone-previews .card');
                for (let i = 0; i < files.length; i++) {
                    var file = files[i];
                    
                    let urlImage = "{{ route('file.draft.show', ['file_id' => 'file_id']) }}";
                    urlImage = urlImage.replace('file_id', file.id);

                    let urlDeleteImage = "{{ route('file.draft.delete', ['file_id' => 'file_id']) }}";
                    urlDeleteImage = urlDeleteImage.replace('file_id', file.id);
                    html += `<div class="p-2">
                                    <div class="row align-items-center">
                                        <input type="hidden" name="file_id[]" value="${file.id}" />
                                        <div class="col-auto">
                                            <img src="${urlImage}" class="avatar-sm rounded bg-light">
                                        </div>
                                        <div class="col pl-0">
                                            <a href="javascript:void(0);" class="text-muted font-weight-bold">
                                                ${file.name}
                                                </a>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="${urlDeleteImage}" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>`;
                }

                listImages.append(html);


            } else {
                alert('Upload ảnh lỗi');
            }
        });
    </script>
@endpush
