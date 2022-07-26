<form class="row g-3 needs-validation" id="projectsFinancialsForm" novalidate method="POST" action="{{ route('shareholders.store')}}?user_id={{isset($user_info) ? $user_info->id : ''}}" enctype="multipart/form-data">
    @csrf



    @if(isset($investor_info))

    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select @if($errors->has('expertise_id')) is-invalid @endif select2" id="expertiseId" name="expertise_id[]" multiple required>
                <option value="" disabled>Please select</option>
                @foreach($expertises as $expertise)
                 @foreach($userExpertises as $select_expertise)
                <option value="{{$expertise->id}}" {{ $select_expertise->expertise_id == $expertise->id ? 'selected' : '' }} > {{$expertise->title}}</option>
                @endforeach
                @endforeach
            </select>
            <label for="expertiseId" class="form-label">Expertise <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">expertise is required!</div>
        </div>
    </div>


   
    @else
    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select @if($errors->has('expertise_id')) is-invalid @endif select2" id="expertiseId" name="expertise_id[]" multiple required>
                <option value="">Please select</option>
                @foreach($expertises as $expertise)
                <option value="{{$expertise->id}}" @if (old('expertise_id')==$expertise->id) {{ 'selected' }} @endif>{{$expertise->title}}</option>
                @endforeach
            </select>
            <label for="expertiseId" class="form-label">Expertise <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">expertise is required!</div>
        </div>
    </div>
    @endif


 @if(isset($investor_info))

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('country_id')) is-invalid @endif" id="countryId" name="country_id" aria-label="Country select" required>
                    <option value="">Please select</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{ $investor_info->country_id == $country->id ? 'selected' : '' }} > {{$country->country_name}}</option>
                    @endforeach
                </select>
                <label for="countryId" class="form-label">Country <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">Country is required!</div>
            </div>
        </div>
        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('country_id')) is-invalid @endif" id="countryId" name="country_id" aria-label="Country select" required>
                    <option value="">Please select</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" @if (old('country_id')==$country->id) {{ 'selected' }} @endif>{{$country->country_name}}</option>
                    @endforeach
                </select>
                <label for="countryId" class="form-label">Country <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">country is required!</div>
            </div>
        </div>
        @endif


  
    @if(isset($investor_info))

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select @if($errors->has('investmentRange_id')) is-invalid @endif" id="investmentRangeId" name="investment_range_id" aria-label="Sector select" required>
                <option value="">Please select</option>
                @foreach($investmentRanges as $investmentRange)
                <option value="{{$investmentRange->id}}" {{ $investor_info->investment_range_id == $investmentRange->id ? 'selected' : '' }} > {{$investmentRange->title}}</option>
                @endforeach
            </select>
            <label for="investmentRangeId" class="form-label">Investment Range <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">investmentRange is required!</div>
        </div>
    </div>
    @else
    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select @if($errors->has('investmentRange_id')) is-invalid @endif" id="investmentRangeId" name="investment_range_id" aria-label="Sector select" required>
                <option value="">Please select</option>
                @foreach($investmentRanges as $investmentRange)
                <option value="{{$investmentRange->id}}" @if (old('investment_range_id')==$investmentRange->id) {{ 'selected' }} @endif>{{$investmentRange->title}}</option>
                @endforeach
            </select>
            <label for="investmentRangeId" class="form-label">investmentRange <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">investmentRange is required!</div>
        </div>
    </div>
    @endif


   

    <div class="col-md-3 col-sm-12">
        <div class="form-label-group in-border">
            <input type="file" class="form-control image" id="picture" name="picture" placeholder="logo" value="{{ old('picture') }}" accept="image/*">
            <label for="picture" class="form-label">Profile Picture</label>
        </div>
    </div>

    <?php
        $string = isset($investor_info->picture) ? $investor_info->picture: '/files/user_profiles/user-dummy-img.jpg';
        $path = $string;
        if (str_contains($string, 'pdf')) {
            $path = '/files/blogs/doc.png';
        } 
        ?>

        <div class="col-md-1 col-sm-12">
            <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($investor_info->picture) ? trim($string) : '/files/user_profiles/user-dummy-img.jpg' }}">
                <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($investor_info->picture) ? trim($path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
            </a>
        </div>


     <!-- added new fields  -->

    @if(isset($investor_info->investment_on_behalf))


    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">I Invest on behalf of .</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="mySelf" value="myself" {{ $investor_info->investment_on_behalf == 'myself' ? 'checked' : '' }} >
                <label class="form-check-label" for="mySelf">
                    Myself
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="groupOfFiends" value="group of friends" {{ $investor_info->investment_on_behalf == 'group of friends' ? 'checked' : '' }} >
                <label class="form-check-label" for="groupOfFiends">
                    Group of Friends
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="fundBanks" value="investment fund or bank" {{ $investor_info->investment_on_behalf == 'investment fund or bank' ? 'checked' : '' }} >
                <label class="form-check-label" for="fundBanks">
                    Investment Fund or Bank
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="other" value="other" {{ $investor_info->investment_on_behalf == 'other' ? 'checked' : '' }} >
                <label class="form-check-label" for="other">
                    Others
                </label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">I Invest on behalf of .</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="mySelf" value="myself" {{ old('investment_on_behalf') == 'myself' ? 'checked' : '' }} >
                <label class="form-check-label" for="mySelf">
                    Myself
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="groupOfFiends" value="group of friends" {{ old('investment_on_behalf') == 'group of friends' ? 'checked' : '' }} >
                <label class="form-check-label" for="groupOfFiends">
                    Group of Friends
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="fundBanks" value="investment fund or bank" {{ old('investment_on_behalf') == 'investment fund or bank' ? 'checked' : '' }} >
                <label class="form-check-label" for="fundBanks">
                    Investment Fund or Bank
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="investment_on_behalf" id="other" value="other" {{ old('investment_on_behalf') == 'other' ? 'checked' : '' }} >
                <label class="form-check-label" for="other">
                    Others
                </label>
            </div>

        </div>
    </div>

    @endif

    @if(isset($investor_info->reason_to_join_c_hub))


    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What is the main reason for registering with Collaboration Hub ?</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="GeneratingFinancialReturns" value="Generating financial returns" {{ $investor_info->reason_to_join_c_hub == 'Generating financial returns' ? 'checked' : '' }} >
                <label class="form-check-label" for="GeneratingFinancialReturns">
                    Generating financial returns
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="MeetingNewPeople" value="Meeting new people and expand my network" {{ $investor_info->reason_to_join_c_hub == 'Meeting new people and expand my network' ? 'checked' : '' }} >
                <label class="form-check-label" for="MeetingNewPeople">
                    Meeting new people and expand my network
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="LearningStart_upInvestment" value="Learning more about Start-up Investment" {{ $investor_info->reason_to_join_c_hub == 'Learning more about Start-up Investment' ? 'checked' : '' }} >
                <label class="form-check-label" for="LearningStart_upInvestment">
                    Learning more about Start-up Investment
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="ContributeInPakistan" value="Contribute my part to support business activity in Pakistan" {{ $investor_info->reason_to_join_c_hub == 'Contribute my part to support business activity in Pakistan' ? 'checked' : '' }} >
                <label class="form-check-label" for="ContributeInPakistan">
                    Contribute my part to support business activity in Pakistan
                </label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What is the main reason for registering with Collaboration Hub ?</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="GeneratingFinancialReturns" value="Generating financial returns" {{ old('reason_to_join_c_hub') == 'Generating financial returns' ? 'checked' : '' }} >
                <label class="form-check-label" for="GeneratingFinancialReturns">
                    Generating financial returns
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="MeetingNewPeople" value="Meeting new people and expand my network" {{ old('reason_to_join_c_hub') == 'Meeting new people and expand my network' ? 'checked' : '' }} >
                <label class="form-check-label" for="MeetingNewPeople">
                    Meeting new people and expand my network
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="LearningStart_upInvestment" value="Learning more about Start-up Investment" {{ old('reason_to_join_c_hub') == 'Learning more about Start-up Investment' ? 'checked' : '' }} >
                <label class="form-check-label" for="LearningStart_upInvestment">
                    Learning more about Start-up Investment
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="reason_to_join_c_hub" id="ContributeInPakistan" value="Contribute my part to support business activity in Pakistan" {{ old('reason_to_join_c_hub') == 'other' ? 'checked' : '' }} >
                <label class="form-check-label" for="ContributeInPakistan">
                    Contribute my part to support business activity in Pakistan
                </label>
            </div>

        </div>
    </div>

    @endif


    @if(isset($investor_info->venture_backed_experience))


    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What is your experience of investing in venture-backed start-ups or VC funds.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="directly" value="directly" {{ $investor_info->venture_backed_experience == 'directly' ? 'checked' : '' }} >
                <label class="form-check-label" for="directly">
                    I invested in a start-up directly or through a single-purpose vehicle (SPV)
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="indirectly" value="indirectly" {{ $investor_info->venture_backed_experience == 'indirectly' ? 'checked' : '' }} >
                <label class="form-check-label" for="indirectly">
                    I invested in start-ups indirectly through a venture fund
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="investmentFirm" value="investment firm" {{ $investor_info->venture_backed_experience == 'investment firm' ? 'checked' : '' }} >
                <label class="form-check-label" for="investmentFirm">
                     represent a Venture Capital or Investment firm
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="none" value="none" {{ $investor_info->venture_backed_experience == 'none' ? 'checked' : '' }} >
                <label class="form-check-label" for="none">
                    None of the above
                </label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What is your experience of investing in venture-backed start-ups or VC funds.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="directly" value="directly" {{ old('venture_backed_experience') == 'directly' ? 'checked' : '' }} >
                <label class="form-check-label" for="directly">
                    I invested in a start-up directly or through a single-purpose vehicle (SPV)
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="indirectly" value="indirectly" {{ old('venture_backed_experience') == 'indirectly' ? 'checked' : '' }} >
                <label class="form-check-label" for="indirectly">
                    I invested in start-ups indirectly through a venture fund
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="investmentFirm" value="investment firm" {{ old('venture_backed_experience') == 'investment firm' ? 'checked' : '' }} >
                <label class="form-check-label" for="investmentFirm">
                     represent a Venture Capital or Investment firm
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="venture_backed_experience" id="none" value="none" {{ old('venture_backed_experience') == 'none' ? 'checked' : '' }} >
                <label class="form-check-label" for="none">
                    None of the above
                </label>
            </div>

        </div>
    </div>

    @endif


    @if(isset($investor_info->interested))


    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">Would you be interested to be a mentor to one or more projects.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="yes" value="yes" {{ $investor_info->interested == 'yes' ? 'checked' : '' }} >
                <label class="form-check-label" for="yes">Yes</label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="no" value="no" {{ $investor_info->interested == 'no' ? 'checked' : '' }} >
                <label class="form-check-label" for="no">No</label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="mayBe" value="may_be" {{ $investor_info->interested == 'may_be' ? 'checked' : '' }} >
                <label class="form-check-label" for="mayBe">Maybe</label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-12 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">Would you be interested to be a mentor to one or more projects</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="yes" value="yes" {{ old('interested') == 'yes' ? 'checked' : '' }} >
                <label class="form-check-label" for="yes">Yes</label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="no" value="no" {{ old('interested') == 'no' ? 'checked' : '' }} >
                <label class="form-check-label" for="no">No</label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested" id="mayBe" value="may_be" {{ old('interested') == 'may_be' ? 'checked' : '' }} >
                <label class="form-check-label" for="mayBe">Maybe</label>
            </div>

        </div>
    </div>

    @endif



    <!-- End -->

    


     @if(isset($investor_info->terms_and_condition))


     <div class="col-md-12 col-sm-12">
        <div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="termsAndCondition" name="terms_and_condition" {{ $investor_info->terms_and_condition == 'yes' ? 'checked' : '' }}>
                <label class="form-check-label" for="termsAndCondition">
                    I accept the following Term & Conditions
                </label>
            </div>
            <p>As an investor with Collaboration Hub, Pakistan, you will receive access to our investment platform with a wealth of diligence information about companies seeking investment and, as such, are expected to adhere to the following Principles of Membership: 

                I understand the risk of investment in startups and businesses and will not hold ‘Collaboration Hub’ responsible for my loss
                I will respect the confidentiality of information provided
                I will do my own due diligence of the information provided on this site and consult my legal advisors before investing
                I will remain active and engaged with the platform and being non-active & non-responsive will result in termination of my membership
                Access to Collaboration Hub, Pakistan is reserved for registered individuals and representatives with the intention of investing, not investment managers seeking deal flow
            Potential investors are expected to invest through Collaboration Hub Pakistan when access to an investment opportunity has been provided and may not syndicate directly or on any other platform or for any other group (non-circumvent and non-compete)</p>
            <p><span class="text-danger">Note:</span>Please note the date and time of the consent given by investor.</p>

        </div>
    </div>

    @else

    <div class="col-md-12 col-sm-12">
        <div>
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="termsAndCondition" name="terms_and_condition" {{ old('interested') == 'yes' ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="termsAndCondition">
                    I accept the following Term & Conditions
                </label>
            </div>
            <p>As an investor with Collaboration Hub, Pakistan, you will receive access to our investment platform with a wealth of diligence information about companies seeking investment and, as such, are expected to adhere to the following Principles of Membership: 

                I understand the risk of investment in startups and businesses and will not hold ‘Collaboration Hub’ responsible for my loss
                I will respect the confidentiality of information provided
                I will do my own due diligence of the information provided on this site and consult my legal advisors before investing
                I will remain active and engaged with the platform and being non-active & non-responsive will result in termination of my membership
                Access to Collaboration Hub, Pakistan is reserved for registered individuals and representatives with the intention of investing, not investment managers seeking deal flow
            Potential investors are expected to invest through Collaboration Hub Pakistan when access to an investment opportunity has been provided and may not syndicate directly or on any other platform or for any other group (non-circumvent and non-compete)</p>
            <p><span class="text-danger">Note:</span>&nbsp;Please note the date and time of the consent given by investor.</p>

        </div>
    </div>

    @endif

    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <textarea class="form-control" id="aboutMe" placeholder="Please enter" name="about_me" maxlength="500" spellcheck="true"> {{ isset($investor_info) ? $investor_info->about_me : old('about_me') }}</textarea>
            
            <label for="aboutMe" class="form-label">About Me</label>           
        </div>
    </div>

    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="otherdetails">
        <input id="base64dataInvestor" type="hidden" name="base64data" value="">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('shareholders.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
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
        $("#crop").click(function() {
            $modal.modal('hide');
            canvas = cropper.getCroppedCanvas({});
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64dataInvestor').val(base64data);
                }
            });
        });
    </script>
@endpush
