@extends('backend.layouts.app', ['activePage' => 'diamonds', 'title' => 'All Diamond', 'navName' => 'alldiamond', 'activeButton' => 'blog'])

@section('content')

<!-- Page Header -->
<div class="page-header mb-4">
    <nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-no-gutter">
			<li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('backend.diamonds.list') }}">Diamonds</a></li>
			<li class="breadcrumb-item active" aria-current="page">All Diamonds</li>
		</ol>
	</nav>
    <div class="row align-items-center mb-3">
        <div class="col-sm mb-2 mb-sm-0">
            <h1 class="page-header-title">Diamond <span class="badge bg-soft-dark text-dark ms-2">{{ count($diamonds) }}</span></h1>
        </div>
        <!-- End Col -->

        <div class="col-sm-auto">
            <a class="btn btn-primary" href="{{ route('backend.diamonds.create') }}">Create Diamond</a>
        </div>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>
<!-- End Page Header -->

<div class="row">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="datatable-custom position-relative">
                <table class="table table-lg table-thead-bordered table-nowrap table-align-middle card-table dataTable table-responsive no-footer">
                    <thead class="thead-light">
                        <th class="sorting_disabled" aria-label="">
                            <div class="form-checkbox">
                                <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">
                                <label class="form-check-label" for="datatableCheckAll"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>mm Size</th>
                        <th>Carat Weight</th>
                        <th></th>
                    </thead>

                    <tbody>
                        @foreach ($diamonds as $diamond)
                            <tr>
                                <td class="table-column-pe-0">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="ordersCheck1">
                                        <label class="form-check-label" for="ordersCheck1"></label>
                                    </div>
                                </td>
                                <td>{{ $diamond->id }}</td>
                                <td>{{ $diamond->material->name }}</td>
                                <td>{{ $diamond->mm_size }}</td>
                                <td>{{ $diamond->carat_weight }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-dark btn-sm" href="{{ route('backend.diamonds.edit', $diamond->id) }}">Edit</a>
                                        <!-- Button Group -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="ordersExportDropdown1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                            <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="ordersExportDropdown1" style="">
                                                <span class="dropdown-header">Options</span>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this diamond?')" href="{{route('backend.diamonds.delete', $diamond->id)}}">Delete</a>
                                            </div>
                                        </div>
                                        <!-- End Unfold -->
                                    </div>
                                    <!-- End Button -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_content')
<script>
$(function() {
    $('.table').DataTable({
        processing: true,
        serverSide: true,
        bAutoWidth: false,
        ajax: '{{ route('backend.diamonds.get') }}',
        columns: []
    });
});
</script>
@endsection
