@extends('admin.layouts.master')

@section('title')
    Add Product
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="pro_name">Name</label>
                        <input type="text" name="name" id="pro_name" class="form-control"
                            value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control"
                            value="{{ old('qty') }}">
                        @if ($errors->has('qty'))
                            <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="category_id">Category</label>
                        <select class="form-control select2" name="category_id" id="category_id" data-toggle="select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="brand_id">Brand</label>
                        <select class="form-control select2" name="brand_id" id="brand_id" data-toggle="select2">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand_id'))
                            <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ old('price') }}">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="promotion_price">Promotion Price</label>
                        <input type="number" name="promotion_price" id="promotion_price" class="form-control"
                               value="{{ old('promotion_price') }}">
                        @if ($errors->has('promotion_price'))
                            <span class="text-danger">{{ $errors->first('promotion_price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="type">Type</label>
                        <select class="form-control select2" name="type" id="type" data-toggle="select2">
                            @foreach ($types as $key => $value)
                                <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('type'))
                            <span class="text-danger">{{ $errors->first('type') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="short_desc">Description</label>
                        <input type="text" name="short_description" id="short_desc" class="form-control">
                    </div>

                    <div class="col-sm-12 mt-2 mb-2">

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

                <div class="float-right mt-2 mb-3">
                    <button type="submit" class="btn btn-primary" id="create">Create</button>
                </div>
            </div>
        </form>
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
                                            <a href="${urlDeleteImage}" class="btn btn-link btn-lg text-muted" data-dz-remove="">
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>`;
                };

                listImages.append(html);


            } else {
                alert('Upload ảnh lỗi');
            }
        });
    </script>
@endpush
