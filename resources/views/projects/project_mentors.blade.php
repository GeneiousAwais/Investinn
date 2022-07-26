<div class="card">
    <div class="card-header">
        <div class="card-body">
            @if(isset($projectMentor) && !empty($projectMentor))
            <form method="POST" action="{{ route('project-mentors.store')}}?id={{$projectMentor->id}}&project_id={{$projectMentor->project_id}}" class="row g-3 needs-validation" id="projectsTeamsForm" novalidate>
                @else
                <form class="row g-3 needs-validation" id="projectsTeamsForm" novalidate method="POST" action="{{ route('project-mentors.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
                    @endif
                    @csrf

                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('project_mentor')) is-invalid @endif select2" id="userId" name="project_mentor[]" multiple required>
                                <option value="" disabled>Please select</option>
                                 @foreach($investors as $investor)                                 
                                        <option value="{{$investor->id}}" @if (old('project_mentor')==$investor->id) {{ 'selected' }} @endif >{{$investor->name}}</option>
                                @endforeach
                            </select>
                            <label for="userId" class="form-label fs-5 fs-lg-1">Project Investor <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if($errors->has('project_mentor'))
                                    {{ $errors->first('project_mentor') }}
                                @else
                                    Mentor is required!
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="col-12 text-end">
                        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="mentors">
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
                    @if(isset($projectMentor) && !empty($projectMentor))
                    <input type="hidden" name="project_id" id="projectId" value="{{isset($projectMentor) ? $projectMentor->project_id : ''}}">
                    @else
                    <input type="hidden" name="project_id" id="projectId" value="{{isset($project) ? $project->id : ''}}">
                    @endif
                    <h4 class="card-title mb-0 flex-grow-1">Mentors Details</h4>
                </div>

                <div class="card-body">

                    <table id="project-mentor-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mentor</th>
                                <th>Email</th>
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

            $('#project-mentor-data-table').DataTable({
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
                    url: "{{ route('project-mentors.index') }}",
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
                    data: 'user.email',
                    name: 'user.email'
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
