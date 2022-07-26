<div class="card">
    <div class="card-header">
        <div class="card-body">
            @if(isset($projectMedia) && !empty($projectMedia))
            <form method="POST" action="{{ route('project-media.store')}}?id={{$projectMedia->id}}&project_id={{$projectMedia->project_id}}" class="row g-3 needs-validation" id="projectsMediaForm" enctype="multipart/form-data" novalidate>
            @else
            <form class="row g-3 needs-validation" id="projectsMediaForm" novalidate method="POST" action="{{ route('project-media.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="col-md-7 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="logo" value="{{ isset($projectMedia->picture) ? trim($projectMedia->picture) : old('blog_image') }}" accept="image/*">
                        <label for="featuredImage" class="form-label fs-5 fs-lg-1">Upload Photo</label>
                    </div>
                </div>

               
 
                <?php
                $string = isset($projectMedia->picture) ? $projectMedia->picture : '/files/user_profiles/user-dummy-img.jpg';
                $path = $string;
                if (str_contains($string, 'pdf')) {
                    $path = '/files/blogs/doc.png';
                } 
                ?>

                <div class="col-md-1 col-sm-12">
                    <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($projectMedia->picture) ? trim($string) : '/files/user_profiles/user-dummy-img.jpg' }}">
                        <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($projectMedia->picture) ? trim($path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
                    </a>
                </div>

                 <div class="col-md-6 col-sm-12 d-none">
                    <div class="form-label-group in-border input-group">
                        <input type="text" class="form-control" id="videoLink" name="video_link" placeholder="Please enter " value="{{ isset($projectMedia->video_link) ? trim($projectMedia->video_link) : old('video_link') }}">
                        <div class="input-group-text"><i class="ri-youtube-fill"></i> </div>
                        <label for="videoLink" class="form-label fs-5 fs-lg-1">Video Link</label>
                    </div>
                </div>

                

                <div class="col-md-4 col-sm-12 text-end">
                    <input type="hidden" class="form-control" id="form_info" name="form_info"  value="photos">
                    <input id="base64dataPhoto" type="hidden" name="base64data" value="">
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
                @if(isset($projectMedia) && !empty($projectMedia))
                <input type="hidden" name="project_id" id="projectId" value="{{isset($projectMedia) ? $projectMedia->project_id : ''}}">
                @else
                <input type="hidden" name="project_id" id="projectId" value="{{isset($project) ? $project->id : ''}}">
                @endif
                <h4 class="card-title mb-0 flex-grow-1">Media info</h4>
            </div>

            <div class="card-body">

                <table id="project-media-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>photo</th>
                            <th>Featured</th>
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

        $('#project-media-data-table').DataTable({
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
                    url: "{{ route('project-media.index') }}",
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
                    data: 'picture',
                    name: 'picture',
                    render: function( data, type, full, meta ) {

                        var str1 = data;
                        var str2 = "pdf";
                        var path = data;
                        if(str1.indexOf(str2) != -1){
                            path = '/files/blogs/doc.png';
                        }

                        return '<a href="javascript:void(0);" class="preview-img" data-url="/files/project_media/'+ data +'"><img class="rounded avatar-xs header-profile-user mt-1" src="/files/project_media/'+ path +'" alt="Header Avatar" /></a>';
                    }
                },
                {
                    data: 'is_featured',
                    name: 'is_featured',
                    orderable: false,
                        searchable: false,
                        width: "5%",
                    sClass: "text-center",
                    render: function( data, type, full, meta,row ) {
                        // console.log(full.id);

                            var str1 = data;
                            var str2 = "pdf";
                            var path = data;
                            var checked= '';
                            if(str1.indexOf(str2) != -1){
                                path = '/files/blogs/doc.png';
                            }
                            if(data == 1){
                                checked='checked';
                            }

                            return '<div class="form-check form-switch form-switch-lg form-switch-success m-3"><input class="form-check-input is_featured" type="checkbox" name="is_featured" data-media_id="'+full.id+'" role="switch" id="SwitchCheck_'+full.id+'" '+checked+' value="'+data+'" ></div>';
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


    $(document).on('change', '.is_featured', function(){
        var id = $(this).data('media_id');
        var checkedValue = $(this).val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')},
            url: "{{route('mark-featured')}}",
            type: 'POST',
            data: {
                id: id,
                project_id: $('#projectId').val(),
                checkedValue: checkedValue,
            },
            dataType: 'json',
            success: function(data){
                // alert(data.success);
                $('#project-media-data-table').DataTable().ajax.reload(null, false);
            },
            complete: function (data) {
                console.log(data);

            }
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
                $('#base64dataPhoto').val(base64data);
            }
        });
    });

</script>

@endpush
