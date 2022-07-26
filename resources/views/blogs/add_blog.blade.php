@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">{{ isset($blog->title) ? $blog->title : 'Create New Blog' }}</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data" id="blogForm">
                    @csrf
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="Blog title" name="title" value="{{ old('title') }}" required>
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if($errors->has('title'))
                                {{ $errors->first('title') }}
                                @else
                                Title is required!
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12 ">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('published_by')) is-invalid @endif" id="publishedBy" name="published_by" aria-label="Please select" required>
                                <option value="">Please select</option>
                                @foreach($staffs as $staff)
                                <option value="{{$staff->id}}" @if (old('published_by')==$staff->id) {{ 'selected' }} @endif>{{$staff->name}}</option>
                                @endforeach
                            </select>
                            <label for="publishedBy" class="form-label">Published By <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if($errors->has('published_by'))
                                {{ $errors->first('published_by') }}
                                @else
                                Published is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled selected>Please Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <label for="isActive" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="blog_image" value="{{ old('blog_image') }}">
                            <label for="featuredImage" class="form-label">Upload Banner</label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" id="metaTags" placeholder="Tags" name="meta_tags" value="{{ old('meta_tags') }}">
                            <label for="metaTags" class="form-label">Meta Tags</label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="metaDesc" placeholder="Please enter" name="meta_description" maxlength="500"></textarea>
                            <label for="metaDesc" class="form-label">Meta Description</label>
                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12">
                        <div>
                            <textarea class="form-control ckeditor-description" id="description" placeholder="Please enter" name="description" ></textarea>
                        </div>
                    </div>

                    
                    <div class="col-12 text-end">
                        <input id="base64data" type="hidden" name="base64data" value="">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('blogs.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

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

    // var $modal = $('#blogModal');
    // var image = document.getElementById('image');
    // var cropper;




       
        
    //     $("body").on("change", ".image", function(e) {
    //         var files = e.target.files;
    //         var done = function(url) {
    //             image.src = url;
    //             $modal.modal('show');
    //         };
    //         var reader;
    //         var file;
    //         var url;
    //         if (files && files.length > 0) {
    //             file = files[0];
    //             if (URL) {
    //                 done(URL.createObjectURL(file));
    //             } else if (FileReader) {
    //                 reader = new FileReader();
    //                 reader.onload = function(e) {
    //                     done(reader.result);
    //                 };
    //                 reader.readAsDataURL(file);
    //             }
    //         }
    //     });

    //     $modal.on('shown.bs.modal', function() {
    //         cropper = new Cropper(image, {
    //             aspectRatio: 1,
    //             viewMode: 3,
    //             dragMode:crop,
    //             preview: '.preview',
    //             cropBoxResizable: false,
    //             cropBoxMovable: true
    //         });

    //     }).on('hidden.bs.modal', function() {
    //         cropper.destroy();
    //         cropper = null;
    //     });

        $("#crop").click(function() {
            $modal.modal('hide');
            canvas = cropper.getCroppedCanvas({
              width: 310,
              height: 150,
              minWidth: 310,
              minHeight: 150,
              maxWidth: 4096,
              maxHeight: 4096,
              fillColor: '#fff',
              imageSmoothingEnabled: false,
              imageSmoothingQuality: 'high',
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