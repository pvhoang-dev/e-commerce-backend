@extends('admin.layouts.master')

@section('title')
    Add Product
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="pro_name">Name</label>
                        <input type="text" name="name" id="pro_name" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="category_id">Category</label>
                        <select class="form-control select2" name="category_id" id="category_id" data-toggle="select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_1">Plv_1</label>
                        <input type="number" name="plv_1" id="plv_1" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_2">Plv_2</label>
                        <input type="number" name="plv_2" id="plv_2" class="form-control">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="plv_3">Plv_3</label>
                        <input type="number" name="plv_3" id="plv_3" class="form-control">
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="short_desc">Description</label>
                        <input type="text" name="short_description" id="short_desc" class="form-control">
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
                <button type="submit" class="btn btn-primary" id="create">Create</button>
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
