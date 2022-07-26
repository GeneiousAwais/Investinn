<form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('users.update',isset($user_info) ? $user_info->id : '') }}">
    @method('PATCH')
    @csrf

    <div class="col-md-6 col-sm-12">
        <div class="form-label-group in-border">
            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="investorPassword" name="password" placeholder="Please enter " value="{{old('password') }}" required>
            <label for="investorPassword" class="form-label">New Password</label>
            <div class="invalid-tooltip">
                @if($errors->has('password'))
                {{ $errors->first('password') }}
                @else
                Password is required!
                @endif
            </div>            
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-label-group in-border">
            <input type="password" class="form-control @if($errors->has('conf_password')) is-invalid @endif" id="investorConfirmPassword" name="conf_password" placeholder="Please enter " value="{{old('conf_password') }}" required>
            <label for="investorConfirmPassword" class="form-label">Confirm Password</label>
            <div class="invalid-tooltip">
                @if($errors->has('conf_password'))
                {{ $errors->first('conf_password') }}
                @else
                Confirm Password is required!
                @endif
            </div>               
        </div>
    </div>


    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="changePassword">
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



