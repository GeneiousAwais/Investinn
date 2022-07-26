<form class="row g-3 needs-validation" id="locationForm" novalidate method="POST" action="{{ route('project-potential-location.store')}}?project_id={{isset($project) ? $project->id : ''}}">
    @csrf

    <div class="row mt-3">
        <div class="col-md-6 col-sm-12" >            
            <div class="row mt-3 mb-3">
                <div class="col-md-6 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control @if($errors->has('location_title')) is-invalid @endif" id="locationTitle" name="location_title" placeholder="Please enter" value="{{isset($projectLocation->location_title) ? $projectLocation->location_title : old('location_title')}}" spellcheck="true" required>
                        <label for="locationTitle" class="form-label fs-5 fs-lg-1">Location Title</label>
                        <div class="invalid-tooltip">
                            @if($errors->has('location_title'))
                            {{ $errors->first('location_title') }}
                            @else
                            Location Title is required!
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control map-input" id="address-input" name="full_address" placeholder="Please enter" value="{{isset($projectLocation->full_address) ? $projectLocation->full_address : old('full_address')}}">
                        <label for="autocomplete" class="form-label fs-5 fs-lg-1">Search Location</label>
                    </div>
                </div>
            </div>

            
            
            <div class="row mt-3 mb-3">
                <div class="col-md-6 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control @if($errors->has('latitude')) is-invalid @endif" id="address-latitude" name="latitude" placeholder="Please enter" value="{{isset($projectLocation->latitude) ? $projectLocation->latitude : old('latitude')}}" readonly required>
                        <label for="address-latitude" class="form-label fs-5 fs-lg-1">Latitude</label>
                        <div class="invalid-tooltip">
                            @if($errors->has('latitude'))
                            {{ $errors->first('latitude') }}
                            @else
                            Latitude Title is required!
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control @if($errors->has('longitude')) is-invalid @endif" id="address-longitude" name="longitude" placeholder="Please enter contact person name" value="{{isset($projectLocation->longitude) ? $projectLocation->longitude : old('longitude')}}" readonly required>
                        <label for="address-longitude" class="form-label fs-5 fs-lg-1">Longitude</label>
                        <div class="invalid-tooltip">
                            @if($errors->has('longitude'))
                            {{ $errors->first('longitude') }}
                            @else
                            Longitude Title is required!
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end mb-3">
                <input type="hidden" class="form-control" id="form_info" name="form_info"  value="potentail_location">
                <button class="btn btn-primary" type="submit">Add Location</button>
                
            </div>

            <div id="address-map-container" style="width:100%;height:400px; ">
                <div style="width: 100%; height: 100%" id="address-map"></div>
            </div>
            
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="table-responsive mt-4 mt-xl-0">
                <table id="project-location-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Location</th>
                            <th style="width:5%">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>


    

    
</form>

@push('header_scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">
<!-- <style type="text/css">
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
</style> -->

@endpush

@push('footer_scripts')

<script type="text/javascript">
    var project_url = "{{ route('project-locations') }}";
    var project_id = "{{ isset($project) ? $project->id : '' }}";
</script>


<script src="/js/mapInput.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCY159aZnkp48EtppY_uQrohXre3vGr5h8&libraries=places&callback=initialize" async defer type="text/javascript"></script>

<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript">
     $(document).ready(function() {



        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#project-location-data-table').DataTable({
            retrieve: true,
            processing: true,
            scrollX: true,
            scrollCollapse: true,
            searching: false,
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
            responsive: true,
            bLengthChange: false,
            // fixedColumns: {
            //     right:1
            // },
            pageLength: 10,
            ajax: {
                    url: "{{ route('project-potential-location.index') }}",
                    data: function ( d ) {
                        d.project_id = "{{isset($project) ? $project->id : ''}}";
                    }
                },

            columns: [
                {
                    data: 'location_title',
                    name: 'location_title'
                },
                {
                    data: 'full_address',
                    name: 'full_address'
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