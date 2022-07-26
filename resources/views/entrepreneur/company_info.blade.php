<div class="card">
    <div class="card-header">
        <div class="card-body">

            <form class="row g-3 needs-validation" id="contactUsForm" novalidate method="POST" action="{{ route('entrepreneur-companies.store')}}?user_id={{isset($user_info) ? $user_info->id : ''}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="companyName" name="company_name" placeholder="Please enter" value="{{ isset($entrepreneurCompanyInfo->company_name) ? trim($entrepreneurCompanyInfo->company_name) : old('company_name') }}"  maxlength="150" spellcheck="true">
                        <label for="companyName" class="form-label fs-5 fs-lg-1">Company Name</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="websiteLink" name="website_link" placeholder="Please enter website link" value="{{ isset($entrepreneurCompanyInfo->website_link) ? trim($entrepreneurCompanyInfo->website_link) : old('website_link') }}" maxlength="150" spellcheck="true">
                        <label for="websiteLink" class="form-label fs-5 fs-lg-1">Website Link</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="contactPerson" name="contact_person" placeholder="Please enter contact person name" value="{{ isset($entrepreneurCompanyInfo->contact_person) ? trim($entrepreneurCompanyInfo->contact_person) : old('contact_person') }}" maxlength="150" spellcheck="true">
                        <label for="contactPerson" class="form-label fs-5 fs-lg-1">Contact Person</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Please enter" value="{{ isset($entrepreneurCompanyInfo->email) ? trim($entrepreneurCompanyInfo->email) : old('email') }}" spellcheck="true">
                        <label for="email" class="form-label fs-5 fs-lg-1">Email</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Please enter phone_no" value="{{ isset($entrepreneurCompanyInfo->phone_no) ? trim($entrepreneurCompanyInfo->phone_no) : old('phone_no') }}" >
                        <label for="phone_no" class="form-label fs-5 fs-lg-1">Phone No</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="text" class="form-control" id="designation" name="designation" placeholder="Please enter designation" value="{{ isset($entrepreneurCompanyInfo->designation) ? trim($entrepreneurCompanyInfo->designation) : old('designation') }}" spellcheck="true">
                        <label for="designation" class="form-label fs-5 fs-lg-1" >Designation</label>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="form-label-group in-border">
                        <input type="file" class="form-control image" id="picture" name="logo" placeholder="logo" value="{{ old('logo') }}" accept="image/*">
                        <label for="picture" class="form-label fs-5 fs-lg-1">Upload logo</label>
                    </div>
                </div>

                <?php

                $logo = isset($entrepreneurCompanyInfo->logo) ? trim($entrepreneurCompanyInfo->logo): '/files/user_profiles/user-dummy-img.jpg';
                $logo_path = $logo;
                if (str_contains($logo, 'pdf')) {
                    $logo_path = '/files/blogs/doc.png';
                } 
                ?>

                <div class="col-md-1 col-sm-12">
                    <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($entrepreneurCompanyInfo->logo) ? trim($logo) : '/files/user_profiles/user-dummy-img.jpg' }}">
                        <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($entrepreneurCompanyInfo->logo) ? trim($logo_path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
                    </a>
                </div>




                <div class="col-12 text-end">
                    <input type="hidden" class="form-control" id="form_info" name="form_info"  value="contact_us">
                    <input id="base64dataContact" type="hidden" name="base64data" value="">
                    <button class="btn btn-primary" type="submit">Save Record</button>
                    <a href="{{ route('entrepreneurs.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


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
                $('#base64dataContact').val(base64data);
            }
        });
    });
</script>
@endpush


