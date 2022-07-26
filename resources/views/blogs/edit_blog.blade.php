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
                <form class="row g-3 needs-validation" novalidate action="{{ route('blogs.update', $blog->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                id="title" name="title" placeholder="Please enter title"
                                value="{{ $blog->title }}" required>
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('title'))
                                    {{ $errors->first('title') }}
                                @else
                                    Title is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('published_by')) is-invalid @endif" id="publishedBy" name="published_by" aria-label="Please select" required >
                                <option value="">Please select</option>
                                @foreach($staffs as $staff)
                                <option value="{{$staff->id}}" {{ $blog->published_by == $staff->id ? 'selected' : '' }}>{{$staff->name}}</option>
                                @endforeach
                            </select>
                            <label for="publishedBy" class="form-label">Published By <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                Published by is required!
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled >Please Select</option>
                                <option value="1" @if (trim($blog->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($blog->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="logo" value="{{ isset($blog) ? trim($blog->featured_image) : old('blog_image') }}" accept="image/*">
                            <label for="featuredImage" class="form-label">Upload Banner</label>
                        </div>
                    </div>

                    <?php
                    $string = $blog->featured_image;
                    $path = $blog->featured_image;
                    if (str_contains($string, 'pdf')) {
                        $path = '/files/blogs/doc.png';
                    } 
                    ?>

                    <div class="col-md-1 col-sm-12">
                        <a href="{{ isset($blog) ? trim($string) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" ><img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($blog) ? trim($path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar"></a>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" id="metaTags" placeholder="Tags" name="meta_tags" value="{{ isset($blog) ? trim($blog->meta_tags) : old('meta_tags') }}">
                            <label for="metaTags" class="form-label">Meta Tags</label>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">
                            <textarea class="form-control" id="metaDesc" placeholder="Please enter" name="meta_description" maxlength="500">{{ isset($blog) ? trim($blog->meta_description) : '' }}</textarea>
                            <label for="metaDesc" class="form-label">Meta Description</label>
                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12">
                        <div>
                            <textarea class="form-control ckeditor-description" id="description" placeholder="Please enter" name="description"  maxlength="800">{{ isset($blog) ? trim($blog->description) : '' }} </textarea>
                        </div>
                    </div>

                   

                    <div class="col-12 text-end">
                        <input id="base64data" type="hidden" name="base64data" value="">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('blogs.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
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


    $("#crop").click(function() {
        $modal.modal('hide');
        canvas = cropper.getCroppedCanvas({});
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
