<div class="card">
    <div class="card-header">
        <div class="card-body">
                <form class="row g-3 needs-validation" id="projectsSDGForm" novalidate method="POST" action="{{ route('project-sdgs.store')}}?investor_id={{isset($user_info) ? $user_info->id : ''}}" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('sdg_id')) is-invalid @endif select2" id="sdgID" name="sdg_id[]" multiple required>
                                <option value="" disabled>Please select</option>
                                 @foreach($sdgs as $sdg)                                 
                                        <option value="{{$sdg->id}}" @if (old('sdg_id')==$sdg->id) {{ 'selected' }} @endif >{{$sdg->sdg_name}}</option>
                                @endforeach
                            </select>
                            <label for="sdgID" class="form-label">SDG <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if($errors->has('sdg_id'))
                                    {{ $errors->first('sdg_id') }}
                                @else
                                    SDG is required!
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="col-12 text-end">
                        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="investor_sdgs">
                        <button class="btn btn-primary" type="submit" >Save Record</button>
                        <a href="{{ route('shareholders.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <input type="hidden" name="investor_id" id="investorId" value="{{isset($user_info) ? $user_info->id : ''}}">
                    <h4 class="card-title mb-0 flex-grow-1">SDG Details</h4>
                </div>

                <div class="card-body">

                    <table id="project-sdg-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SDG</th>
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

    @endpush

    @push('footer_scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $.extend($.fn.dataTableExt.oStdClasses, {
                "sFilterInput": "form-control",
                "sLengthSelect": "form-control"
            });

            $('#project-sdg-data-table').DataTable({
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
                    url: "{{ route('project-sdgs.index') }}",
                    data: function ( d ) {
                        d.investor_id = $('#investorId').val();
                        
                    }
                },

                columns: [

                {
                    data: 'id',
                    name: 'id',
                    width: "5%"
                },
                {
                    data: 'sdg.sdg_name',
                    name: 'sdg.sdg_name'
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
