<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{route('project-media.store')}}" enctype="multipart/form-data" 
        class="dropzone" id="dropzone">
        <input type="hidden" name="project_id" id="project_id" value="{{ isset($project->id) ? $project->id : '' }}">
        @csrf
        <div class="dz-default dz-message">Drop Files here or click to upload</div>
    </form>  
    </div>
</div>
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



@push('header_scripts') 
<link rel="stylesheet" href="{{ asset('theme/dist/default/assets/libs/dropzone/dropzone.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ asset('theme/croppic/croppic.css') }}" type="text/css" />

<style type="text/css">
   .dz-image img {
    width: 100%;
    height: 100%;
}
.dropzone.dz-started .dz-message {
    display: block !important;
}
.dropzone {
    border: 2px dashed #028AF4 !important;;
}
.dropzone .dz-preview.dz-complete .dz-success-mark {
    opacity: 1;
}
.dropzone .dz-preview.dz-error .dz-success-mark {
    opacity: 0;
}
.dropzone .dz-preview .dz-error-message{
    top: 144px;
}
</style>
@endpush


@push('footer_scripts')
<script src="{{ asset('theme/dist/default/assets/libs/dropzone/dropzone-min.js') }}"></script>
<script src="{{ asset('theme/croppic/croppic.js') }}"></script>

<script>

    Dropzone.options.dropzone =
    {
        maxFiles: 5, 
        maxFilesize: 4,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 50000,
        init:function() {
            var project_id = $('#project_id').val();
            var myDropzone = this;
            $.ajax({
                url: "{{route('getimages')}}?project_id="+project_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    $.each(data, function (key, value) {
                        var file = {name: value.name, size: value.size};
                        myDropzone.options.addedfile.call(myDropzone, file);
                        myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                        myDropzone.emit("complete", file);
                        
                    });
                     
                    
                },
                complete: function (data) {
                    console.log(data);
                    
                }
            });
        },
        removedfile: function(file) 
        {
            if (this.options.dictRemoveFile) {
                return Dropzone.confirm("Are You Sure to "+this.options.dictRemoveFile, function() {
                    if(file.previewElement.id != ""){
                        var name = file.previewElement.id;
                    }else{
                        var name = file.name;
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                        },
                        type: 'POST',
                        url: "{{route('image-delete')}}",
                        data: {filename: name},
                        success: function (data){
                            alert(data.success +" File has been successfully removed!");
                                $('#project-media-data-table').DataTable().ajax.reload(null, false);
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
                });
            }       
        },

        success: function(file, response) 
        {
            file.previewElement.id = response.success;
            var olddatadzname = file.previewElement.querySelector("[data-dz-name]");   
            file.previewElement.querySelector("img").alt = response.success;
            olddatadzname.innerHTML = response.success;
            $('#project-media-data-table').DataTable().ajax.reload(null, false); 
            // setTimeout(function() {
            //     $('#project-media-data-table').DataTable().ajax.reload(null, false);
            // }, 2000);

        },
        error: function(file, response)
        {
         if($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        };

        $(document).ready(function() {

            $("#dropzone").dropzone({});
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

                        return '<a href="/files/project_media/'+ data +'" target="_blank" ><img class="rounded avatar-xs header-profile-user mt-1" src="/files/project_media/'+ path +'" alt="Header Avatar" /></a>';
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




    </script>



    @endpush
