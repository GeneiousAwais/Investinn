@extends('layouts.master')

@section('content')
<div class="row" id="page-body">
    <div class="col-lg-12">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">List of Investors Interested projects</h4>
            <div class="flex-shrink-0 d-none">
                <a href="{{ route('interests.create') }}" class="btn btn-success btn-label btn-sm">
                    <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="interests-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Investor Name</th>
                            <th>Project</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Investor Name</th>
                            <th>Project</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>


            </div>
        </div>
    </div>
</div>


@endsection


@push('header_scripts')


@endpush

@push('footer_scripts')

<script type="text/javascript">
    $(document).ready(function() {
        
        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#interests-table').DataTable({
            retrieve: true,
            processing: true,
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
            responsive: true,
            bLengthChange: false,
            pageLength: 10,
            scrollX: true,
            ajax: "{{ route('interests.index') }}",
            columns: [{
                data: 'id',
                name: 'id',
                width: "5%"
            },
            {
                data: 'user.name',
                name: 'user.name',
                width: "25%"
            },
            {
                data: 'project.project_title',
                name: 'project.project_title',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "5%",
                sClass: "text-center"
            }],
            "order": [[0, 'DESC']]
        });
    });
</script>

@endpush
