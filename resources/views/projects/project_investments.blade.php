<div class="card">
    <div class="card-header">
        <div class="card-body">
            @if(isset($projectInvestment) && !empty($projectInvestment))
            <form method="POST" action="{{ route('project-investors.store')}}?id={{$projectInvestment->id}}&project_id={{$projectInvestment->project_id}}" class="row g-3 needs-validation" id="projectsTeamsForm" novalidate>
                @else
                <form class="row g-3 needs-validation" id="projectsTeamsForm" novalidate method="POST" action="{{ route('project-investors.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    @if(isset($projectInvestment) && !empty($projectInvestment))


                    <div class="col-md-4 col-sm-12 ">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('project_investor')) is-invalid @endif" id="userId" name="project_investor" aria-label="Please select" searchable="Search here.." required>
                                <option value="">Please select</option>
                                @foreach($investors as $investor)
                                <option value="{{$investor->id}}"{{ $projectInvestment->project_investor == $investor->id ? 'selected' : '' }}>{{$investor->name}}</option>
                                @endforeach
                            </select>
                            <label for="userId" class="form-label fs-5 fs-lg-1">Project Investor</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('project_investor'))
                                {{ $errors->first('project_investor') }}
                                @else
                                Investor is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    @else

                    <div class="col-md-4 col-sm-12 ">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('project_investor')) is-invalid @endif" id="userId" name="project_investor" aria-label="Please select" searchable="Search here.." required>
                                <option value="">Please select</option>
                                @foreach($investors as $investor)
                                <option value="{{$investor->id}}" @if (old('project_investor')==$investor->id) {{ 'selected' }} @endif>{{$investor->name}}</option>
                                @endforeach
                            </select>
                            <label for="userId" class="form-label fs-5 fs-lg-1">Project Investor</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('project_investor'))
                                {{ $errors->first('project_investor') }}
                                @else
                                Investor is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border input-group">
                            <input type="number" class="form-control @if($errors->has('invest_amount')) is-invalid @endif" id="investAmount" name="invest_amount" placeholder="Please enter" value="{{ isset($projectInvestment->invest_amount) ? trim($projectInvestment->invest_amount) : old('invest_amount') }}" required>
                            <div class="input-group-text">$</div>
                            <label for="investAmount" class="form-label fs-5 fs-lg-1">Amount</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('invest_amount'))
                                {{ $errors->first('invest_amount') }}
                                @else
                                Amount is required!
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-12 text-end">
                        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="investors">
                        <button class="btn btn-primary" type="submit" >Save Record</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    @if(isset($projectInvestment) && !empty($projectInvestment))
                    <input type="hidden" name="project_id" id="projectId" value="{{isset($projectInvestment) ? $projectInvestment->project_id : ''}}">
                    @else
                    <input type="hidden" name="project_id" id="projectId" value="{{isset($project) ? $project->id : ''}}">
                    @endif
                    <h4 class="card-title mb-0 flex-grow-1">Investment Details</h4>
                </div>

                <div class="card-body">

                    <table id="project-investment-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Investor</th>
                                <th>Amount <small><strong>($)</strong></small></th>
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

            $('#project-investment-data-table').DataTable({
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
                    url: "{{ route('project-investors.index') }}",
                    data: function ( d ) {
                        d.project_id = $('#projectId').val();
                        
                    }
                },

                columns: [

                {
                    data: 'id',
                    name: 'id',
                    width: "5%"
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'invest_amount',
                    name: 'invest_amount'
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
