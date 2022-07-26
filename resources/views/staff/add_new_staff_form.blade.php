@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'personaldetails' || request()->query('tab') == 'personaldetails_edit' ? 'active' : '' }} "  data-bs-toggle="tab" href="#personalDetail" role="tab" aria-selected="true">
                            <i class="fas fa-home"></i>Personal Details
                        </a>
                    </li>

                    <li class="nav-item {{request()->query('tab') == 'personaldetails' ? 'd-none' : '' }}">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false">
                            <i class="far fa-user"></i>
                            Change Password
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane {{ request()->query('tab') == 'personaldetails' || request()->query('tab') == 'personaldetails_edit' ? 'active' : '' }} " id="personalDetail" role="tabpanel">
                        @include('staff.add_staff')
                    </div>

                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        @include('staff.change_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="staffModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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


@endsection

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


<script type="text/javascript">

    var $modal = $('#staffModal');
    var image = document.getElementById('image');
    var cropper;

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
                dragMode:crop,
                preview: '.preview',
                cropBoxResizable: false,
                cropBoxMovable: true
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

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
