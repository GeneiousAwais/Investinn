@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Volunteer Details</h4>
                <div class="flex-shrink-0">
                    <a href="{{ route('volunteers.create')}}?tab=personaldetails" class="btn btn-success btn-label btn-sm" style="margin-right: 10px;">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New Volunteer
                    </a>
                </div>

                <div class="flex-shrink-0">
                    <a href="{{ route('archived-volunteer')}}" class="btn btn-primary btn-label btn-sm">
                        <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i>Archived Volunteer
                    </a>
                </div>
            </div>

            <div class="card-body">

                <table id="volunteer-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
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

        $('#volunteer-data-table').DataTable({
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
            ajax: "{{ route('volunteers.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    width: "5%"
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                
                {
                    data: 'status',
                    name: 'status',
                    defaultContent: 'N/A',
                },
                
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: "5%"
                }
            ]
        });
    });
</script>

@endpush
