
<form class="row g-3 needs-validation mt-3" id="projectsMediaForm" novalidate method="POST" action="{{ route('project-media.store')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
    <div class="col-md-6">
        <div class="form-label-group in-border">
            <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="logo" value="{{ isset($projectMedia->picture) ? trim($projectMedia->picture) : old('blog_image') }}" accept="image/*">
            <label for="featuredImage" class="form-label">Upload Photo</label>
        </div>
    </div>
    <div class="col-6 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="photos">
        <input id="base64data" type="hidden" name="base64data" value="">
        <button class="btn btn-primary" type="submit" {{ isset($projectMediaCount) && ($projectMediaCount >= 5) ? 'disabled' : '' }} >Upload</button>
        <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>


<hr/>
<div class="row">
    <div class="col-lg-12">
        <table id="project-media-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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

        $.extend($.fn.dataTableExt.oStdClasses, {
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });

        $('#project-media-data-table').DataTable({
            retrieve: true,
            processing: true,
            paging: false,
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
            responsive: true,
            bLengthChange: false,
            pageLength: 10,
            scrollX: true,
            bSort: false,
            ajax: {
                url: "{{ route('project-media.index') }}",
                data: function ( d ) {
                    d.project_id = $('#project_id').val();
                }
            },
            columns: [

                {
                    data: 'id',
                    name: 'id',
                    width: "1%"
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
                    width: "1%"
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
