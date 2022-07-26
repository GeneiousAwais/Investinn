<form class="row g-3 needs-validation" id="locationForm" novalidate method="POST" action="{{ route('project-potential-location.store')}}?project_id={{isset($project) ? $project->id : ''}}">
    @csrf

    <div class="row mt-3">
        <div class="col-md-6 col-sm-12" >
            <div class="form-label-group in-border">
                <input type="text" class="form-control map-input" id="address-input" name="full_address" placeholder="Please enter" value="">
                <label for="autocomplete" class="form-label">Location</label>
            </div>
            
            
            <div class="row mt-3 mb-3">
                <div class="col-md-5 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="address-latitude" name="latitude" placeholder="Please enter" value="" readonly>
                        <label for="address-latitude" class="form-label">Latitude</label>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 text-end">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="address-longitude" name="longitude" placeholder="Please enter contact person name" value="" readonly>
                        <label for="address-longitude" class="form-label">Longitude</label>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <input type="hidden" class="form-control" id="form_info" name="form_info"  value="potentail_location">
                    <button class="btn btn-primary btn-full" type="submit">Add Location</button>
                </div>
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
                            <th style="width:5%" scope="col">Sr.</th>
                            <th scope="col">Location</th>
                            <th style="width:5%" scope="col">Action</th>
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



<script src="https://maps.google.com/maps/api/js?key=AIzaSyCY159aZnkp48EtppY_uQrohXre3vGr5h8&libraries=places&callback=initialize" async defer type="text/javascript"></script>
<script src="/js/mapInput.js"></script>

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
            fixedColumns: {
                right:1
            },
            pageLength: 10,
            ajax: {
                    url: "{{ route('project-potential-location.index') }}",
                    data: function ( d ) {
                        d.project_id = "{{isset($project) ? $project->id : ''}}";
                        
                    }
                },

            columns: [

                {
                    data: 'id',
                    name: 'id',
                    width: "5%"
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