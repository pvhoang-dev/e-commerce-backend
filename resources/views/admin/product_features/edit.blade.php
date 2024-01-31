@extends('admin.layouts.master')

@section('title')
    Edit Feature Category

    <a href="{{ route('admin.feature_categories.index') }}" class="btn btn-outline-info float-right">
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
        <form action="{{ route('admin.feature_categories.update', ['id' => $featureCategory->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $featureCategory->name }}" name="name" id="name"
                            class="form-control">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="position">Position</label>
                        <input type="number" value="{{ $featureCategory->position }}" name="position" id="position"
                               class="form-control">
                        @if ($errors->has('position'))
                            <span class="text-danger">{{ $errors->first('position') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-footer float-right border-0 bg-transparent">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>

    <div class="row" id="feature-preview">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title d-flex justify-content-between align-items-center">
                    <span>Features of&nbsp;&nbsp;<span class="h4">-&nbsp;&nbsp;{{ $featureCategory->name }}</span></span>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#add-feature-modal">Add Feature</button>
                </div>
            </div>
        </div>
    </div>

    @php
        $features = $featureCategory->features;
    @endphp
    @if($features)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-body p-0">
                        <div class="table-responsive users-table">
                            <table class="table table-centered mb-0 " id="features-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($features as $feature)
                                    <tr>
                                        <td>{{ $feature->name }}</td>
                                        <td>{{ $feature->position ?? 'none' }}</td>
                                        <td>
                                            <form
                                                    action="{{ route('admin.features.delete', $feature->id) }}"
                                                    method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class='btn-group'>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                       data-target="#edit-feature-modal" class="action-icon edit-feature"
                                                       data-feature-id="{{ $feature->id }}">
                                                        <i class="mdi mdi-eye"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Modal Add Feature --}}
    <div id="add-feature-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.features.store') }}?feature_category_id={{ $featureCategory->id }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Add Feature</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="feature_name">Name</label>
                                <input type="text" name="feature_name" id="feature_name"
                                       class="form-control" required>
                            </div>

                            <div class="form-group col-12">
                                <label for="feature_position">Position</label>
                                <input type="number" name="feature_position" id="feature_position"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Feature --}}
    <div id="edit-feature-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.features.update') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Edit Feature</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="edit_feature_name">Name</label>
                                <input type="text" name="edit_feature_name" id="edit_feature_name"
                                       class="form-control" required>
                                <input type="text" name="edit_feature_id" id="edit_feature_id"
                                       class="form-control" hidden>
                            </div>

                            <div class="form-group col-12">
                                <label for="edit_feature_position">Position</label>
                                <input type="number" name="edit_feature_position" id="edit_feature_position"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.edit-feature').click(function () {
                var featureId = $(this).data('feature-id');

                $.ajax({
                    type: 'GET',
                    url: '/admin/features/edit/' + featureId,
                    success: function (data) {
                        $('#edit_feature_name').val(data.name);
                        $('#edit_feature_position').val(data.position);
                        $('#edit_feature_id').val(data.id);
                    },
                    error: function () {
                        alert('Có lỗi xảy ra khi lấy dữ liệu từ server.');
                    }
                });
            });
        });
    </script>
@endpush
