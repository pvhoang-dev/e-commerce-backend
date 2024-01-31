@extends('admin.layouts.master')

@section('title')
    List Feature Category

    <a href="{{ route('admin.feature_categories.create') }}" class="btn btn-outline-primary ml-2">
        Add
    </a>

    <form action="{{ route('admin.feature_categories.index') }}" method="GET" class="ml-auto">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="search" value="{{ $search }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Preview</h4>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="preview_feature_category">Name</label>
                    <select id="preview_feature_category" class="form-control">
                        @foreach($featureCategoriesPreview as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="preview_feature_name">Feature</label>
                    <select id="preview_feature_name" class="form-control"></select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive users-table">
                @if ($featureCategories->count())
                    <table class="table table-centered mb-0 " id="features-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($featureCategories as $featureCategory)
                                <tr>
                                    <td>{{ $featureCategory->name }}</td>
                                    <td>{{ $featureCategory->position ?? 'none' }}</td>
                                    <td>
                                        <form action="{{ route('admin.feature_categories.delete', $featureCategory->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class='btn-group'>
                                                <a class="action-icon"
                                                    href="{{ route('admin.feature_categories.edit', ['id' => $featureCategory->id]) }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
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
                @endif
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $featureCategories->appends(request()->query())->links('admin.pagination.custom') }}
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
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('admin.ajaxGetFeature') }}?feature_category_id=' + '{{ $featureCategoriesPreview->first->get()->id }}',
            }).done(function (data) {
                $("#preview_feature_name").html(data)
            });
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
        });

    </script>
@endpush
