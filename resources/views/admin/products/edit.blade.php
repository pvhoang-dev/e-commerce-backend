@extends('admin.layouts.master')

@section('title')
    Edit Product
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-info float-right">
        <i class="uil uil-corner-up-left-alt"></i> Back
    </a>
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
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update_status', ['id' => $product->id]) }}" method="POST">
                @csrf
                <h4 class="mb-3">Status</h4>
                <hr>
                <div class="form-group col-12">
                    <div>
                        <input class="updateStatus" type="checkbox" id="product-status"
                               name="status"
                               @if ($product->status == 1) checked @endif
                               data-switch="success"
                        />
                        <label for="product-status" data-on-label="Yes" data-off-label="No"
                               class="mb-0 d-block"></label>
                    </div>
                    <span>(public to client or block)</span>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary" id="create">Update status</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <h4 class="mb-3">Information</h4>
                <hr>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="pro_name">Name</label>
                        <input type="text" value="{{ $product->name }}" name="name" id="pro_name"
                               class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="qty">Quantity</label>
                        <input type="number" value="{{ $product->qty }}" name="qty" id="qty"
                               class="form-control">
                        @if ($errors->has('qty'))
                            <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="category_id">Category</label>
                        <select class="form-control select2" name="category_id" id="category_id" data-toggle="select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                            @if ($errors->has('category_id'))
                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="brand_id">Brand</label>
                        <select class="form-control select2" name="brand_id" id="brand_id" data-toggle="select2">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                </option>
                            @endforeach
                            @if ($errors->has('brand_id'))
                                <span class="text-danger">{{ $errors->first('brand_id') }}</span>
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="price">Price</label>
                        <input type="number" value="{{ $product->price }}" name="price" id="price"
                               class="form-control">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="promotion_price">Promotion Price</label>
                        <input type="number" name="promotion_price" id="promotion_price" class="form-control"
                               value="{{ $product->promotion_price }}" disabled="">
                        @if ($errors->has('promotion_price'))
                            <span class="text-danger">{{ $errors->first('promotion_price') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="type">Type</label>
                        <select class="form-control select2" name="type" id="type" data-toggle="select2">
                            @foreach ($types as $key => $value)
                                <option value="{{ $value }}" {{ $product->type == $value ? 'selected' : '' }}>
                                    {{ $key }}
                                </option>
                            @endforeach
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-sm-12">
                        <label for="short_desc">Description</label>
                        <input type="text" value="{{ $product->short_description }}" name="short_description"
                               id="short_desc" class="form-control">
                    </div>
                </div>
                <div class="float-right mt-2 mb-3">
                    <button type="submit" class="btn btn-primary" id="create">Update info</button>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.upload_images', ['id' => $product->id]) }}" method="POST">
                @csrf
                <h4 class="mb-3">Upload Images</h4>
                <hr>
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
                <div class="float-right mt-3">
                    <button type="submit" class="btn btn-primary" id="create">Upload</button>
                </div>
            </form>
        </div>
    </div>

    @if ($product->images->count())
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.products.setup_position_images') }}" method="POST">
                    @csrf
                    <h4 class="mb-3">Product Images</h4>
                    <hr>
                    <div class="row">
                        @foreach ($product->images->sortBy('position') as $img)
                            <div class="col-md-3 col-sm-6 col-12 img-{{ $img->file_id }}">
                                <div class="card ribbon-box">
                                    <div class="card-body border rounded">
                                        <div data-id="{{ $img->file_id }}" role="button" class="deleteImg ribbon ribbon-primary float-right">
                                            <i class="dripicons-cross"></i>
                                        </div>
                                        <div class="float-left custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" name="defaultImage" id="option-{{ $img->file_id }}" @if($img->type) checked @endif value="{{ $img->file_id }}">
                                            <label class="custom-control-label" for="option-{{ $img->file_id }}">Default</label>
                                        </div>
                                        <h5 class="mt-0">
                                            <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm">Pos</span>
                                                </div>
                                                <input name="file[{{ $img->file_id }}]" value="{{ $img->position }}" type="number" class="form-control"
                                                       aria-label="Small">
                                            </div>
                                        </h5>
                                        <div class="ribbon-content">
                                            <a href="{{ route('file.show', $img->file_id) }}" target="_blank">
                                                <img src="{{ route('file.show', $img->file_id) }}" alt="post-img"
                                                     class="rounded mr-1 mb-3 mb-sm-0 img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary" id="create">Save Image</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store_description', ['id' => $product->id]) }}" method="POST">
                @csrf
                <h4 class="mb-3">Description</h4>
                <hr>
                <textarea id="description" name="description">{{ $product->description?->description }}</textarea>

                <div class="float-right mt-3">
                    <button type="submit" class="btn btn-primary" id="create">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <form>
            <div class="card-body">
                @csrf
                <h4 class="mb-3">Specs</h4>
                <hr>

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="preview_feature_category">Name</label>
                        <select id="preview_feature_category" class="form-control">
                            <option value="0">No item</option>
                        @foreach($featureCategoriesPreview as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="preview_feature_name">Feature</label>
                        <select id="preview_feature_name" class="form-control"></select>
                    </div>
                    <div class="form-group col-12">
                        <label for="feature_value">Value</label>
                        <input type="text" name="feature_value" id="feature_value" value="" class="form-control">
                    </div>
                </div>

                <div class="float-right mt-3">
                    <button type="submit" class="btn btn-primary" id="create">Save</button>
                </div>
            </div>
        </form>
    </div>

   {{--
   <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title d-flex justify-content-between align-items-center">
                    Bạn có muốn thêm sản phẩm này vào trang home không?
                </div>

                <label for="add_home_page">
                    <input type="radio" id="add_home_page" name="add_home_page"> Có
                </label>

                <label for="remove_home_page">
                    <input type="radio" id="remove_home_page" name="add_home_page"> Không
                </label>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <form action="{{ route('admin.add_home_page') }}" method="post">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="group">Group</label>
                        <select class="form-control" id="group_id" name="group">
                            @foreach ($groups as $key => $group)
                                <option value="{{ $group }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="group">Position</label>
                        <select name="position" id="position_id" class="form-control">
                            @foreach ($position as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
            </div>
            <div class="card-footer" style="text-align: right">
                <button type="submit" class="btn btn-primary" id="create">Save</button>
            </div>
        </form>
    </div>
    --}}

    <div class="row" id="product-variant-preview">
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
                                <th>Image</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell">Qty</th>
                                <th class="d-none d-sm-table-cell">Price</th>
                                <th class="d-none d-lg-table-cell">Sku</th>
                                <th>Status</th>
                                <th colspan="3">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productVariants as $productVariant)
                                <tr>
                                    <td style="max-width: 20px">
                                        @if ($productVariant->file_id)
                                            <img class="rounded mr-1 mb-3 mb-sm-0 img-fluid"
                                                 src="{{ route('file.show', $productVariant->file_id) }}" alt="">
                                        @else
                                            <img class="rounded mr-1 mb-3 mb-sm-0 img-fluid"
                                                 src="{{ asset('images/default/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $productVariant->name }}</td>
                                    <td class="d-none d-sm-table-cell">
                                        <h4><span class="badge badge-primary">{{ $productVariant->qty }}</span>
                                        </h4>
                                    </td>
                                    <td class="d-none d-sm-table-cell">{{ $productVariant->price }}</td>
                                    <td class="d-none d-lg-table-cell">{{ $productVariant->sku }}</td>
                                    <td>
                                        <div>
                                            <input class="updateVariantStatus" type="checkbox"
                                                   id="product-variants-{{ $productVariant->id }}"
                                                   object="product-variants" data-id="{{ $productVariant->id }}"
                                                   status="{{ $productVariant->status }}"
                                                   @if ($productVariant->status == 1) checked @endif
                                                   data-switch="success"/>
                                            <label for="product-variants-{{ $productVariant->id }}"
                                                   data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <form
                                                action="{{ route('admin.product_variants.delete', $productVariant->id) }}"
                                                method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class='btn-group'>
                                                <a href="{{ route('admin.product_variants.edit', [$productVariant->id]) }}"
                                                   class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                <button type="submit"
                                                        class="action-icon delete border-0 bg-transparent"
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
    {{-- Tiny editor--}}
    <script>
        const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

        tinymce.init({
            selector: '#description',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount charmap quickbars emoticons accordion',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl',
            height: 500,
            image_upload_url: '/upload-image',
            images_upload_handler: function (blobInfo) {
                return new Promise(function (resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', '/upload-image');
                    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector(
                        'meta[name="csrf-token"]').content);

                    xhr.onload = function () {
                        try {
                            if (xhr.status != 200) {
                                throw new Error('HTTP Error: ' + xhr.status);
                            }

                            var json = JSON.parse(xhr.responseText);

                            if (!json || typeof json.location !== 'string') {
                                throw new Error('Invalid JSON: ' + xhr.responseText);
                            }

                            resolve(json.location);
                        } catch (error) {
                            console.error(error);
                            reject(error.message);
                        }
                    };

                    xhr.onerror = function () {
                        console.error('Network error occurred.');
                        reject('Network error occurred.');
                    };

                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                });
            },
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
        });
    </script>

    {{-- Features --}}
    <script>
        @if (session('error'))
        // Display an alert with the error message
        alert("{{ session('error') }}");
        @endif
        @if ($errors->has('message'))
        alert("{{ implode('\n', $errors->get('message')) }}");
        @endif

        $('#uploadFile').change(function () {
            let formData = new FormData();

            let files = $(this)[0].files;

            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            let response = uploadFile(formData);

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
                    html += `<div class="p-2 product-image-${file.id}">
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
                        <button data-href="${urlDeleteImage}" data-id="product-image-${file.id}" class="btn btn-link btn-lg text-muted pre-image" data-dz-remove="">
                        <i class="dripicons-cross"></i>
                        </button>
                        </div>
                        </div>
                        </div>`;
                }

                listImages.append(html);
            } else {
                alert('Upload ảnh lỗi');
            }
        });

        $('.dropzone-previews').on('click', '.pre-image', function (event) {
            event.preventDefault();
            var deleteLink = $(this);
            var dataId = deleteLink.data('id');
            var urlDeleteImage = deleteLink.data('href');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: urlDeleteImage,
                method: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    $('.' + dataId).remove();
                    console.log(response.message);
                },
                error: function (error) {
                    console.error('Error:', error.responseJSON.error);
                }
            });
        });

        $('.deleteImg').on('click', function () {
            if (confirm("Are you sure you want to delete this image?")) {
                let id = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.products.delete_image') }}",
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function (data) {
                        if (data.success == true) {
                            $.NotificationApp.send("Success", data.message, "bottom-right", '#10c469', "success");
                            setTimeout(function() {
                                $(".img-" + id).remove();
                            }, 500);
                        } else {
                            $.NotificationApp.send("Warning", data.message, "bottom-right", '#f9c851', "warning");
                        }
                    }
                });
            }
        });

        $('#add_home_page_product').on('change', function () {
            let product_id = $(this).attr("data-product_id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('add_home_page') }}",
                method: "POST",
                data: {
                    product_id: product_id,
                },
                success: function (data) {
                    console.log(data)
                }
            });
        });

        $('.updateVariantStatus').on('click', function () {
            if (confirm("Are you sure?")) {
                var id = $(this).data('id');

                setTimeout(function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin.product_variants.update_status') }}",
                        method: "POST",
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            if (data.success == true) {
                                $.NotificationApp.send("Success", data.message, "bottom-right", '#10c469', "success");
                            } else {
                                $.NotificationApp.send("Warning", data.message, "bottom-right", '#f9c851', "warning");

                                setTimeout(function () {
                                    location.reload();
                                }, 500)
                            }
                        }
                    });
                }, 0);
            }
        })

        $(document).ready(function() {
            $('#preview_feature_category').select2({
                tags: true
            });
            $('#preview_feature_name').select2({
                tags: true
            });
            $("#preview_feature_category").on("change", function (e) {
                $.ajax({
                    url: '{{ route('admin.ajaxGetFeature') }}?feature_category_id=' + $(this).val(),
                }).done(function (data) {
                    $("#preview_feature_name").html(data)
                });
            })
            $("#preview_feature_name").on("change", function (e) {
                $.ajax({
                    url: '{{ route('admin.product_features.index') }}?id=' + $(this).val(),
                }).done(function (data) {
                    $("#feature_value").val(data.value)
                });
            })
        });
    </script>
@endpush
