@if(isset($user_info))
<form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('users.update',isset($user_info) ? $user_info->id : '') }}">

    @method('PATCH')
    @else
    <form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('users.store') }}" autocomplete="off" >
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

        <div class="col-md-4 col-sm-12 ">
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


        

        @if(!isset($user_info))

        <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' || request()->query('tab') == 'otherdetails' ? 'd-none' : '' }}">
            <div class="form-label-group in-border">
                <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="investorPassword" name="password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('password') }}" autocomplete="off"  required>
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

        <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' || request()->query('tab') == 'otherdetails' ? 'd-none' : '' }}">
            <div class="form-label-group in-border">
                <input type="password" class="form-control @if($errors->has('conf_password')) is-invalid @endif" id="investorConfirmPassword" name="conf_password" placeholder="Please enter " value="{{ isset($user_info) ? $user_info->password : old('conf_password') }}" autocomplete="off" required>
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
            <input type="hidden" class="form-control" id="form_info" name="form_info"  value="personaldetails">
            <input type="hidden" class="form-control" id="userTypeId" name="user_type_id"  value="1">
            <button class="btn btn-primary" type="submit">Save Record</button>
            <a href="{{ route('shareholders.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
        </div>
    </form>
@push('header_scripts')
@endpush
@push('footer_scripts')

<script type="text/javascript">
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


    