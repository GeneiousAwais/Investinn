    @if(isset($user_info))
        <form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('users.update',isset($user_info) ? $user_info->id : '') }}">
        @method('PATCH')
    @else
    <form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('users.store') }}">
        @endif
        @csrf

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="text" class="form-control" id="investorName" name="name" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->name : old('name') }}" required>
                <label for="investorName" class="form-label">Name <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('name'))
                    {{ $errors->first('name') }}
                    @else
                    Name is required!
                    @endif
                </div>           
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif " id="investorEmail" name="email" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->email : old('email') }}" required>
                <label for="investorEmail" class="form-label">Email <span class="text-danger">*</span></label> 
                <div class="invalid-tooltip">
                    @if($errors->has('email'))
                    {{ $errors->first('email') }}
                    @else
                    Email is required!
                    @endif
                </div>              
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Please enter " value="{{ isset($user_info->facebook) ? trim($user_info->facebook) : old('facebook') }}">
                <div class="input-group-text"><i class="ri-facebook-circle-fill"></i> </div>
                <label for="facebook" class="form-label">Facebook</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Please enter " value="{{ isset($user_info->twitter) ? trim($user_info->twitter) : old('twitter') }}">
                <div class="input-group-text"><i class="ri-twitter-fill"></i></div>
                <label for="twitter" class="form-label">Twitter</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="Please enter " value="{{ isset($user_info->linkedin) ? trim($user_info->linkedin) : old('linkedin') }}">
                <div class="input-group-text"><i class="ri-linkedin-box-fill"></i></div>
                <label for="linkedIn" class="form-label">LinkedIn</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Please enter " value="{{ isset($user_info->instagram) ? trim($user_info->instagram) : old('instagram') }}">
                <div class="input-group-text"><i class="ri-instagram-fill"></i></div>
                <label for="instagram" class="form-label">Instagram</label>
            </div>
        </div>


        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="text" class="form-control @if($errors->has('user_name')) is-invalid @endif" id="investorUserName" name="user_name" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->user_name : old('user_name') }}" required >
                <label for="investorUserName" class="form-label">User Name <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('user_name'))
                    {{ $errors->first('user_name') }}
                    @else
                    User Name is required!
                    @endif
                </div>           
            </div>
        </div>

        @if(!isset($user_info))

        <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' ? 'd-none' : '' }}">
            <div class="form-label-group in-border">
                <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="investorPassword" name="password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('password') }}" {{ isset($user_info) ? 'required' : '' }}>
                <label for="investorPassword" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('password'))
                    {{ $errors->first('password') }}
                    @else
                    Password is required!
                    @endif
                </div>            
            </div>
        </div>

        <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' ? 'd-none' : '' }}">
            <div class="form-label-group in-border">
                <input type="password" class="form-control @if($errors->has('conf_password')) is-invalid @endif" id="investorConfirmPassword" name="conf_password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('conf_password') }}" {{ isset($user_info) ? 'required' : '' }}>
                <label for="investorConfirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('conf_password'))
                    {{ $errors->first('conf_password') }}
                    @else
                    Confirm Password is required!
                    @endif
                </div>               
            </div>
        </div>

        @endif



        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="file" class="form-control image" id="profilePicture" name="profile_picture" placeholder="logo" value="{{ isset($user_info) ? trim($user_info->profile_picture) : old('profile_picture') }}" accept="image/*">
                <label for="profilePicture" class="form-label">Profile Picture</label>
            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($user_info) ? trim($user_info->profile_picture) : 'files/user_profiles/user-dummy-img.jpg' }}">
                <img class="rounded-circle header-profile-user mt-1" src="{{ isset($user_info) ? trim($user_info->profile_picture) : 'files/user_profiles/user-dummy-img.jpg' }} " alt="Header Avatar">
            </a>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select mb-3" id="isActive" name="is_active" required>
                    <option value="" disabled >Please Select</option>
                    <option value="1" @if (isset($user_info) && trim($user_info->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                    <option value="0" @if (isset($user_info) && trim($user_info->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                </select>
                <label for="isActive" class="form-label">Status <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">Kindly select the Status!</div>
            </div>
        </div>



        <div class="col-12 text-end">
            <input type="hidden" class="form-control" id="form_info" name="form_info"  value="profile">
            <button class="btn btn-primary" type="submit">Save Record</button>
            <a href="{{ route('dashboard') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
        </div>
    </form>

    <!-- <input type="file" name="image" class="image"> -->

    <div id="modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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

    <script>

        var $modal = $('#modal');
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

            // var cropper = new Cropper(image, {
            //     dragMode: 'move',
            //     autoCropArea: 0.65,
            //     restore: false,
            //     guides: false,
            //     center: false,
            //     highlight: false,
            //     cropBoxMovable: false,
            //     cropBoxResizable: false,
            //     toggleDragModeOnDblclick: false,
            //     data:{ //define cropbox size
            //       width: 240,
            //       height:  90,
            //   },
            // });

        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {

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
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        url: "{{ route('crop-image-upload') }}",
                        data: {
                            'id': '<?= $user_info->id ?>',
                            'image': base64data
                        },
                        success: function(data) {
                            console.log(data);
                            $modal.modal('hide');
                            // alert("Crop image successfully uploaded");
                           location.reload();
                        }
                    });
                }
            });
        });

        $(document).on('blur', '#investorConfirmPassword', function(e) {
            var u_p = $('#investorPassword').val();
            var u_c_p = $('#investorConfirmPassword').val();
            if(u_p != u_c_p){
                alert('Password Miss Match');
                $('#investorConfirmPassword').val('');
                return false;
            }
        });

    </script>

    @endpush
