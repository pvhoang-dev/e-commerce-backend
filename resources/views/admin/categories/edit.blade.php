@extends('admin.layouts.master')

@section('title')
    Edit Category

    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="cate_name">Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" id="cate_name"
                            class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="cate_po">Position</label>
                        <input type="number" value="{{ $category->position }}" name="position" id="cate_po"
                            class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="cate_parent">Category Parent</label>
                        <select class="form-control select2" name="parent_id" id="cate_parent" data-toggle="select2">
                            <option value="0">Category Parent</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}"
                                    {{ $value->id == $category->parent_id ? 'selected' : '' }}>{{ $value->name }}
                                </option>
                            @endforeach
                        </select>
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
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <img src="{{ route('file.show', $category->file_id) }}"
                                                class="avatar-sm rounded bg-light">
                                        </div>
                                        <div class="col pl-0">
                                            <a href="javascript:void(0);" class="text-muted font-weight-bold">
                                                {{ $category->file->name }}
                                            </a>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="${urlDeleteImage}" class="btn btn-link btn-lg text-muted"
                                                data-dz-remove="">
                                                <i class="dripicons-cross"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer float-right border-0 bg-transparent">
                <button type="submit" class="btn btn-primary" id="create">Save</button>
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

                listImages.empty();

                for (let i = 0; i < files.length; i++) {
                    var file = files[i];

                    let urlImage = "{{ route('file.draft.show', ['file_id' => 'file_id']) }}";
                    urlImage = urlImage.replace('file_id', file.id);

                    let urlDeleteImage = "{{ route('file.draft.delete', ['file_id' => 'file_id']) }}";
                    urlDeleteImage = urlDeleteImage.replace('file_id', file.id);
                    html += `<div class="p-2">
                                    <div class="row align-items-center">
                                        <input type="hidden" name="file_id" value="${file.id}" />
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
                }

                listImages.append(html);


            } else {
                alert('Upload ảnh lỗi');
            }
        });
    </script>
@endpush
