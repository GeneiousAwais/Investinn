@extends('layouts.master')

@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Projects Details</h4>
                @permission('create-project')
                <div class="flex-shrink-0">
                    <a href="{{ route('projects.create')}}?tab=summary" class="btn btn-success btn-label btn-sm">
                        <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New Project
                    </a>
                </div>
                @endpermission
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 col-sm-12">
                        <div class="filter form-label-group in-border">
                            <select class="form-select" id="sectorId" name="sector_id" aria-label="Sector select">
                                <option value="">Please select</option>
                                @foreach($sectors as $sector)
                                <option value="{{$sector->id}}" @if (old('sector_id')==$sector->id) {{ 'selected' }} @endif>{{$sector->sector_name}}</option>
                                @endforeach
                            </select>
                            <label for="sectorId" class="form-label fs-5 fs-lg-1">Sector</label>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="filter form-label-group in-border">
                            <select class="form-select" id="stageId" name="project_stage_id" aria-label="Sector select">
                                <option value="">Please select</option>
                                @foreach($projectStages as $stage)
                                <option value="{{$stage->id}}" @if (old('project_stage_id')==$stage->id) {{ 'selected' }} @endif>{{$stage->title}}</option>
                                @endforeach
                            </select>
                            <label for="stageId" class="form-label fs-5 fs-lg-1">Project Stage</label>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-12">
                        <div class="filter form-label-group in-border">
                            <select class="form-select" id="projectEntrepreneur" name="project_entrepreneur" aria-label="Sector select">
                                <option value="">Please select</option>
                                @foreach($entrepreneurs as $entrepreneur)
                                <option value="{{$entrepreneur->id}}" @if (old('project_entrepreneur')==$entrepreneur->id) {{ 'selected' }} @endif>{{$entrepreneur->name}}</option>
                                @endforeach
                            </select>
                            <label for="projectEntrepreneur" class="form-label fs-5 fs-lg-1">Entrepreneur</label>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <input id="myInput" type="text" placeholder="Search.." class="form-control">
                            <label for="myInput" class="form-label fs-5 fs-lg-1">Search...</label>
                        </div>
                    </div>
                </div>

                <table id="projects-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Entrepreneur</th>
                            <th>Sector</th>
                            <th>Project Stage</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Entrepreneur</th>
                            <th>Sector</th>
                            <th>Project Stage</th>
                            <th>Published</th>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
<style type="text/css">
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
</style>
@endpush
@push('footer_scripts')

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#projects-data-table').DataTable({
            searching: false,
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
            fixedColumns: {
                right:1
            },
            scrollCollapse: true,


            // searching: false,
            // serverSide: true,
            // bLengthChange: false,
            // ordering: true,
            // pageLength: 10,
            // scrollX: true,
            // scrollCollapse: true,
            // fixedColumns: {
            //     right:1
            // },


            // retrieve: true,
            // processing: true,
            // language: {
            //     search: "",
            //     searchPlaceholder: "Search..."
            // },
            // responsive: true,
            ajax: {
                url: "{{ route('projects.index') }}",
                data: function ( d ) {
                    d.sector_id = $('#sectorId').val();
                    d.project_stage_id = $('#stageId').val();
                    d.project_entrepreneur = $('#projectEntrepreneur').val();
                    d.searchTerm = $('#myInput').val().toLowerCase();
                }
            },
            columns: [{

                    data: 'id',
                    name: 'id',
                    width: "5%",
                    orderable: false
                },
                {
                    data: 'project_title',
                    name: 'project_title',
                    defaultContent: '<span>N/A</span>'
                },
                {
                    data: 'project_status',
                    name: 'project_status',
                    defaultContent: '<span>N/A</span>'
                },
                
                {
                    data: 'project_entrepreneur.name',
                    name: 'name',
                    defaultContent: '<span>N/A</span>'
                },
                {
                    data: 'sectors.sector_name',
                    name: 'sector_name',
                    defaultContent: '<span>N/A</span>'
                },
                {
                    data: 'stages.title',
                    name: 'title',
                    defaultContent: '<span>N/A</span>'
                },
                {
                    data: 'is_published',
                    name: 'is_published',
                    defaultContent: '<span>N/A</span>',
                    render: function( data, type, full, meta ) {

                            var label = '';
                            if(data == 1){
                                label = 'Published';
                            }
                            else
                            {
                                label = 'Not Published';

                            }

                            return label;
                        }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: "5%"
                }
            ],
            "order": [[0, 'DESC']],
        });
    });

    $(document).on('change', '.filter', function() {
        $('#projects-data-table').DataTable().ajax.reload(null, false);
    });

    $(document).on("keyup",'#myInput', function() {
        var value = $(this).val().toLowerCase();
        if(value.length > 3 || value.length == 0){
            $('#projects-data-table').DataTable().ajax.reload(null, false);
        }
    });

</script>

@endpush
