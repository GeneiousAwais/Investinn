


<div class="row">
    <div class="col-12">
        @if(isset($projectMedia) && !empty($projectMedia))
        <form method="POST" action="{{ route('project-media.store')}}?id={{$projectMedia->id}}&project_id={{$projectMedia->project_id}}" class="row g-3 needs-validation" id="projectsMediaForm" enctype="multipart/form-data" novalidate>
        @else
        <form class="row g-3 needs-validation" id="projectsMediaForm" novalidate method="POST" action="{{ route('project-media.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
        @endif
            @csrf
            <!-- <div class="col-md-5 col-sm-12">
                <div class="form-label-group in-border">
                    <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="logo" value="{{ isset($projectMedia->picture) ? trim($projectMedia->picture) : old('blog_image') }}" accept="image/*">
                    <label for="featuredImage" class="form-label fs-5 fs-lg-1">Upload Photo</label>
                </div>
            </div> -->

            <input type="file" id="filepond" 
                class="filepond"
                name="filepond" 
                multiple 
                data-allow-reorder="true"
                data-max-file-size="3MB"
                data-max-files="10">

        </form>
    </div>
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
                            <th>video</th>
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

<div id="mediaModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Crop Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary " id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>


@push('header_scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<script src="{{ asset('theme/dist/default/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script type="text/javascript">

    

    var $modal = $('#mediaModal');
    var image = document.getElementById('image');
    var cropper;
    $(document).ready(function() {

        FilePond.registerPlugin(FilePondPluginImagePreview);


        const inputElement = document.querySelector('input[id="filepond"]');

        const pond = FilePond.create(inputElement, {
            // allowImageEditor: true
            server: {
                url: '/filepond/api',
                process: '/process',
                revert: '/process',
                patch: "?patch=",
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        pond.on('processfile', (error, file) => {

            if (error) {
                console.log('Oh no');
                return;
            }
            console.log('File processed', file.serverId);

            $.ajax({

                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('project-media.store')}}",
                type: "POST",
                data: {
                    server_id : file.serverId,
                    project_id : '{{ $project->id }}'
                },
                cache: false,
                success: function(data) {

                },
                error: function() {

                },
                beforeSend: function() {

                },
                complete: function() {

                }
            });
        });


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
                    data: 'video_link',
                    name: 'video_link'
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

     $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        $modal.modal('hide');
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $('#base64data').val(base64data);
            }
        });
    });
</script>

@endpush
