@if(isset($user_info))
<form class="row g-3 needs-validation" id="volunteerDetailsForm" novalidate method="POST" action="{{ route('users.update',isset($user_info) ? $user_info->id : '') }}">

    @method('PATCH')
    @else
    <form class="row g-3 needs-validation" id="volunteerDetailsForm" novalidate method="POST" action="{{ route('users.store') }}">
        @endif
        @csrf

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="text" class="form-control" id="investorName" name="name" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->name : old('name') }}" required>
                <label for="investorName" class="form-label fs-5 fs-lg-1">Name <span class="text-danger">*</span></label>
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
                <label for="investorEmail" class="form-label fs-5 fs-lg-1">Email <span class="text-danger">*</span></label> 
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
            <div class="form-label-group in-border">
                <input type="text" class="form-control @if($errors->has('user_name')) is-invalid @endif" id="investorUserName" name="user_name" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->user_name : old('user_name') }}" required >
                <label for="investorUserName" class="form-label fs-5 fs-lg-1">User Name <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('user_name'))
                    {{ $errors->first('user_name') }}
                    @else
                    User Name is required!
                    @endif
                </div>           
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Please enter " value="{{ isset($user_info->facebook) ? trim($user_info->facebook) : old('facebook') }}">
                <div class="input-group-text"><i class="ri-facebook-circle-fill"></i> </div>
                <label for="facebook" class="form-label fs-5 fs-lg-1">Facebook</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Please enter " value="{{ isset($user_info->twitter) ? trim($user_info->twitter) : old('twitter') }}">
                <div class="input-group-text"><i class="ri-twitter-fill"></i></div>
                <label for="twitter" class="form-label fs-5 fs-lg-1">Twitter</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="linkedIn" name="linkedin" placeholder="Please enter " value="{{ isset($user_info->linkedin) ? trim($user_info->linkedin) : old('linkedin') }}">
                <div class="input-group-text"><i class="ri-linkedin-box-fill"></i></div>
                <label for="linkedIn" class="form-label fs-5 fs-lg-1">LinkedIn</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border input-group">
                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Please enter " value="{{ isset($user_info->instagram) ? trim($user_info->instagram) : old('instagram') }}">
                <div class="input-group-text"><i class="ri-instagram-fill"></i></div>
                <label for="instagram" class="form-label fs-5 fs-lg-1">Instagram</label>
            </div>
        </div>


         @if(!isset($user_info))

        <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' ? 'd-none' : '' }}">
            <div class="form-label-group in-border">
                <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="volunteerPassword" name="password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('password') }}" required>
                <label for="volunteerPassword" class="form-label fs-5 fs-lg-1">Password <span class="text-danger">*</span></label>
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
                <input type="password" class="form-control @if($errors->has('conf_password')) is-invalid @endif" id="volunteerConfirmPassword" name="conf_password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('conf_password') }}" required>
                <label for="volunteerConfirmPassword" class="form-label fs-5 fs-lg-1">Confirm Password <span class="text-danger">*</span></label>
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

        <div class="col-md-3 col-sm-12">
            <div class="form-label-group in-border">
                <input type="file" class="form-control image" id="featuredImage" name="blog_image" placeholder="logo" value="{{ isset($user_info) ? trim($user_info->profile_picture) : old('blog_image') }}" accept="image/*">
                <label for="featuredImage" class="form-label fs-5 fs-lg-1">Profile Picture</label>
            </div>
        </div>

        <?php
        $string = isset($user_info->profile_picture) ? $user_info->profile_picture: '/files/user_profiles/user-dummy-img.jpg';
        $path = $string;
        if (str_contains($string, 'pdf')) {
            $path = '/files/blogs/doc.png';
        } 
        ?>

        <div class="col-md-1 col-sm-12">
            <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($user_info) ? trim($string) : '/files/user_profiles/user-dummy-img.jpg' }}">
                <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($user_info) ? trim($path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
            </a>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select mb-3" id="isActive" name="is_active" required>
                    <option value="" disabled >Please Select</option>
                    <option value="1" @if (isset($user_info) && trim($user_info->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                    <option value="0" @if (isset($user_info) && trim($user_info->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                </select>
                <label for="isActive" class="form-label fs-5 fs-lg-1">Status <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">Kindly select the Status!</div>
            </div>
        </div>


        <div class="col-12 text-end">
            <input type="hidden" class="form-control" id="form_info" name="form_info"  value="volunteer">
            <input type="hidden" class="form-control" id="userTypeId" name="user_type_id"  value="5">
            <input id="base64dataVolunteer" type="hidden" name="base64data" value="">
            <button class="btn btn-primary" type="submit">Save Record</button>
            <a href="{{ route('volunteers.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
        </div>
    </form>
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
    $(document).on('blur', '#volunteerConfirmPassword', function(e) {
        var u_p = $('#volunteerPassword').val();
        var u_c_p = $('#volunteerConfirmPassword').val();
        if(u_p != u_c_p){
            alert('Password Miss Match');
            $('#volunteerConfirmPassword').val('');
            return false;
        }
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
                $('#base64dataVolunteer').val(base64data);
            }
        });
    });
</script>

@endpush


    