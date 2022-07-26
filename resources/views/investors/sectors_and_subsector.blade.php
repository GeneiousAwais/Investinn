<div class="card">
    <div class="card-header">
        <div class="card-body">
            <form class="row g-3 needs-validation" id="projectsFinancialsForm" novalidate method="POST" action="{{ route('investors-sectors.store')}}?user_id={{isset($user_info) ? $user_info->id : ''}}" enctype="multipart/form-data">
                @csrf

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <select class="load-select form-select @if($errors->has('sector_id')) is-invalid @endif" data-target="sub_sector_id" data-url="{{ route('list-subsectors') }}" id="sectorId" name="sector_id" aria-label="Sector select" required>
                            <option value="">Please select</option>
                            @foreach($sectors as $sector)
                            <option value="{{$sector->id}}" @if (old('sector_id')==$sector->id) {{ 'selected' }} @endif>{{$sector->sector_name}}</option>
                            @endforeach
                        </select>
                        <label for="sectorId" class="form-label">Sector <span class="text-danger">*</span></label>
                        <div class="invalid-tooltip">sector is required!</div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12  mt-3">
                    <div class="form-label-group in-border">
                        <select class="form-select @if($errors->has('sub_sector_id')) is-invalid @endif" id="subSectorId" name="sub_sector_id[]" aria-label="Sector select" multiple required>
                            <option value="">Please select</option>
                        </select>
                        <label for="subSectorId" class="form-label">Sub Sector <span class="text-danger">*</span></label>
                        <div class="invalid-tooltip">
                            @if($errors->has('sub_sector_id'))
                            {{ $errors->first('sub_sector_id') }}
                            @else
                            sub sector is required!
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-4 col-sm-12 text-end">
                    @if(isset($userSectorsCount) && ($userSectorsCount < 3))
                    <button class="btn btn-primary {{$userSectorsCount}}" type="submit">Save Record</button>
                    <a href="{{ route('shareholders.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    @else
                    <h5><span class="badge badge-label bg-danger"><i class="mdi mdi-circle-medium"></i>Limit Exceeded</span></h5>
                    @endif
                </div>
                
            </form>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Investor Sectors Details</h4>
            </div>

            <div class="card-body">

                <table id="investor-sector-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sector</th>
                            <th>Sub Sector</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('header_scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#subSectorId').select2({
            maximumSelectionLength: 5,
            dropdownAutoWidth : true,
            width: '100%',
            placeholder: "Select Sub Sector",
            allowClear: true
        });

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#investor-sector-data-table').DataTable({
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
            ajax: {
                    url: "{{ route('investors-sectors.index') }}",
                    data: function ( d ) {
                        d.user_id = "{{isset($user_info) ? $user_info->id : ''}}";
                        
                    }
                },

            columns: [

                {
                    data: 'id',
                    name: 'id',
                    width: "5%"
                },
                {
                    data: 'sectors.sector_name',
                    name: 'sectors.sector_name'
                },
                {
                    data: 'sub_sectors.sector_name',
                    name: 'sub_sectors.sector_name'
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


