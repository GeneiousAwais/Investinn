@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Employees </h4>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="employee-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Eamil</th>
                            <th>Roles</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Eamil</th>
                            <th>Roles</th>
                            <th>Permissions</th>
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

        $('#employee-table').dataTable({
            searching: true,
            processing: true,
            serverSide: true,
            responsive: true,
            bLengthChange: false,
            ordering: true,
            pageLength: 10,
            scrollX: true,
            language: {search: "", searchPlaceholder: "Search..."},
            ajax:
            {
                url: "{{ route('users.index') }}",
            },
            columns: [
                {   data: 'id', name: 'id'    },
                {   data: 'name', name: 'name'  },
                {   data: 'email', name: 'email'  },
                {   data: 'roles', name: 'roles'  },
                {   data: 'permissions', name: 'permissions'  },
                {   data: 'action', name: 'action', orderable: false, searchable: false,  width: "5%",  sClass: 'text-center'   }
            ]
        });
    });

    // $(document).on('change', '.filter', function() {
    //     $('#employee-table').DataTable().ajax.reload(null, false);
	// });

    $(document).on("keyup",'#mySearch', function() {
			var value = $(this).val().toLowerCase();
			if(value.length > 0 || value.length == 0){
				$('#employee-table').DataTable().ajax.reload(null, false);
			}
		});

</script>

@endpush
