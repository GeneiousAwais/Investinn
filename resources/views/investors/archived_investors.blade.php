@extends('layouts.master')

@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Archived investors Details</h4>
            </div>

            <div class="card-body">

                <table id="archived-investors-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            
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

        $('#archived-investors-data-table').DataTable({
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
            ajax: "{{ route('archived-investors') }}",
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
                    data: 'action',
                    name: 'action',
                    width: "5%"
                }
            ],
            order: [[0, 'DESC']],
        });
    });

    $(document).on('click', '#restoreArchived' , function(){
        console.log('id');
    });
</script>

@endpush
