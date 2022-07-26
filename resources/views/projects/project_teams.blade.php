
            @if(isset($projectTeam) && !empty($projectTeam))
            <form method="POST" action="{{ route('project-teams.store')}}?id={{$projectTeam->id}}&project_id={{$projectTeam->project_id}}" class="row g-3 needs-validation" id="projectsTeamsForm" novalidate enctype="multipart/form-data">
            @else
            <form class="row g-3 needs-validation" id="projectsTeamsForm" novalidate method="POST" action="{{ route('project-teams.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="teamName" name="team_name" placeholder="Please enter" value="{{ isset($projectTeam->team_name) && !empty($projectTeam->team_name) ? trim($projectTeam->team_name) : old('team_name') }}" spellcheck="true">
                        <label for="teamName" class="form-label fs-5 fs-lg-1">Member's Name</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="teamRole" name="team_role" placeholder="Please enter" value="{{ isset($projectTeam->team_role) && !empty($projectTeam->team_role) ? trim($projectTeam->team_role) : old('team_role') }}" spellcheck="true">
                        <label for="teamRole" class="form-label fs-5 fs-lg-1">Member's Role</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="teamBio" name="team_bio" placeholder="Please enter" value="{{ isset($projectTeam->team_bio) && !empty($projectTeam->team_bio) ? trim($projectTeam->team_bio) : old('team_bio') }}" spellcheck="true">
                        <label for="teamBio" class="form-label fs-5 fs-lg-1">Member's Expertise</label>
                    </div>
                </div>

               

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="input-group form-label-group in-border">
                        <textarea class="form-control" id="teamOverview" placeholder="Please enter" name="team_overview" maxlength="500" spellcheck="true"> {{ isset($projectTeam) && !empty($projectTeam) ? trim($projectTeam->team_overview) : '' }}</textarea>
                        <label for="teamOverview" class="form-label fs-5 fs-lg-1">Member's role in this project</label>
                    </div>
                </div>

                 <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border input-group">
                        <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Please enter " value="{{ isset($projectTeam->facebook) ? trim($projectTeam->facebook) : old('facebook') }}" spellcheck="true">
                        <div class="input-group-text"><i class="ri-facebook-circle-fill"></i> </div>
                        <label for="facebook" class="form-label fs-5 fs-lg-1">Facebook</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border input-group">
                        <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Please enter " value="{{ isset($projectTeam->twitter) ? trim($projectTeam->twitter) : old('twitter') }}" spellcheck="true">
                        <div class="input-group-text"><i class="ri-twitter-fill"></i></div>
                        <label for="twitter" class="form-label fs-5 fs-lg-1">Twitter</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border input-group">
                        <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="Please enter " value="{{ isset($projectTeam->linkedin) ? trim($projectTeam->linkedin) : old('linkedin') }}" spellcheck="true">
                        <div class="input-group-text"><i class="ri-linkedin-box-fill"></i></div>
                        <label for="linkedIn" class="form-label fs-5 fs-lg-1">LinkedIn</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border input-group">
                        <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Please enter " value="{{ isset($projectTeam->instagram) ? trim($projectTeam->instagram) : old('instagram') }}" spellcheck="true">
                        <div class="input-group-text"><i class="ri-instagram-fill"></i></div>
                        <label for="instagram" class="form-label fs-5 fs-lg-1">Instagram</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="file" class="form-control image" id="picture" name="picture" placeholder="logo" value="{{ old('picture') }}" accept="image/*">
                        <label for="picture" class="form-label fs-5 fs-lg-1">Logo</label>
                    </div>
                </div>

                <?php
                $string = isset($projectTeam->picture) ? $projectTeam->picture: '/files/user_profiles/user-dummy-img.jpg';
                $path = $string;
                if (str_contains($string, 'pdf')) {
                    $path = '/files/blogs/doc.png';
                } 
                ?>

                <div class="col-md-1 col-sm-12">
                    <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($projectTeam->picture) ? trim($string) : '/files/user_profiles/user-dummy-img.jpg' }}">
                        <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($projectTeam->picture) ? trim($path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
                    </a>
                </div>




                <div class="col-md-3 col-sm-12 text-end">
                    <input type="hidden" class="form-control" id="form_info" name="form_info"  value="teams">
                    <input id="base64dataTeams" type="hidden" name="base64data" value="">
                    <button class="btn btn-primary" type="submit" {{ isset($projectTeam) && empty($projectTeam) && ($totalTeamMembers >= 5) ? 'disabled' : '' }} >Save Record</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                </div>
            </form>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                @if(isset($projectTeam) && !empty($projectTeam))
                <input type="hidden" name="project_id" id="projectId" value="{{isset($projectTeam) ? $projectTeam->project_id : ''}}">
                @else
                <input type="hidden" name="project_id" id="projectId" value="{{isset($project) ? $project->id : ''}}">
                @endif
                <h4 class="card-title mb-0 flex-grow-1">Team Members Details</h4>
            </div>

            <div class="card-body">

                <table id="project-teams-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Biograpgy</th>
                            <th>Logo</th>
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

<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
@endpush

@push('footer_scripts')
<script type="text/javascript">

    $(document).ready(function() {

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#project-teams-data-table').DataTable({
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
                    url: "{{ route('project-teams.index') }}",
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
                    data: 'team_name',
                    name: 'team_name'
                },
                {
                    data: 'team_role',
                    name: 'team_role'
                },
                
                {
                    data: 'team_bio',
                    name: 'team_bio'
                },
                {
                    data: 'picture',
                    name: 'picture',
                    width: "10%",
                    render: function( data, type, full, meta ) {

                        var str1 = data;
                        var str2 = "pdf";
                        var path = data;
                        if(str1.indexOf(str2) != -1){
                            path = '/files/blogs/doc.png';
                        }

                        return '<a href="'+ data +'" target="_blank" ><img class="rounded avatar-xs header-profile-user mt-1" src="'+ path +'" alt="Header Avatar" /></a>';
                    }
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

    $("#crop").click(function() {
        $modal.modal('hide');
        canvas = cropper.getCroppedCanvas({});
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $('#base64dataTeams').val(base64data);
            }
        });
    });

</script>

@endpush
