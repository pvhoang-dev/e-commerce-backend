@extends('admin.layouts.master')

@section('title')
    Edit Menu

    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.menus.update', ['id' => $menu->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $menu->name }}">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="position">Position</label>
                        <input type="number" name="position" id="position" class="form-control"
                            value="{{ $menu->position }}">
                        @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-12">
                        <label for="cate_parent">Menu Parent</label>
                        <select class="form-control select2" name="parent_id" id="cate_parent" data-toggle="select2">
                            <option value="0">Menu Parent</option>
                            @foreach ($menus as $_menu)
                                @if ($_menu['id'] != $menu->id)
                                    <option value="{{ $_menu['id'] }}"
                                        {{ $_menu['id'] == $menu->parent_id ? 'selected' : '' }}>{{ $_menu['name'] }}
                                    </option>
                                    @if (!empty($_menu['sub_menus']))
                                        @foreach ($_menu['sub_menus'] as $subMenu)
                                            @if ($subMenu['id'] != $menu->id)
                                                <option value="{{ $subMenu['id'] }}"
                                                    {{ $subMenu['id'] == $menu->parent_id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&#45;&#45;{{ $subMenu['name'] }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('parent_id'))
                            <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-12">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url" class="form-control"
                            value="{{ $menu->url ?? '' }}">
                        @if ($errors->has('url'))
                            <span class="text-danger">{{ $errors->first('url') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="class_name">Class name</label>
                        <input type="text" name="class_name" id="class_name" class="form-control"
                            value="{{ $menu->class_name ?? '' }}">
                        @if ($errors->has('class_name'))
                            <span class="text-danger">{{ $errors->first('class_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="id_name">Id name</label>
                        <input type="text" name="id_name" id="id_name" class="form-control"
                            value="{{ $menu->id_name ?? '' }}">
                        @if ($errors->has('id_name'))
                            <span class="text-danger">{{ $errors->first('id_name') }}</span>
                        @endif
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
