@extends('admin.layouts.master')

@section('title')
    Add Banner

    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
@endsection
@section('content')
    <div class="card">
        <form action="{{ route('admin.banners.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="banner_name">Title</label>
                        <input type="text" name="title" id="banner_name" class="form-control">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                        @if ($errors->has('slug'))
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-6">
                        <label for="banner_po">Position</label>
                        <input type="number" name="position" id="banner_po" class="form-control">
                        @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-12">
                        <label for="banner_url">Url</label>
                        <input type="text" name="url" id="banner_url" class="form-control">
                        @if ($errors->has('url'))
                            <span class="text-danger">{{ $errors->first('url') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-12">
                        <div class="dropzone">
                            <div class="dz-message needsclick">
                                <label for="uploadFile" style="cursor: pointer; display:block;">
                                    <i class="h1 text-muted dripicons-cloud-upload"></i>
                                    <h4>Drop files here or click to upload.</h4>
                                    <input type="file" id="uploadFile" style="display: none">
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('file_id'))
                            <span class="text-danger">{{ $errors->first('file_id') }}</span>
                        @endif
                        <!-- Preview -->
                        <div class="dropzone-previews mt-3">
                            <div class="card mt-1 mb-0 shadow-none border dz-processing dz-error dz-complete">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer float-right border-0 bg-transparent">
                <button type="submit" class="btn btn-primary" id="create">Create</button>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $('#uploadFile').change(function () {
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
