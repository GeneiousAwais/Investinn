<form class="row g-3 needs-validation" id="volunteerOtherDetailsForm" novalidate method="POST" action="{{ route('volunteers.store')}}?user_id={{isset($user_info) ? $user_info->id : ''}}" enctype="multipart/form-data">
    @csrf

    <div class="col-md-6 col-sm-12">
        <div class="form-label-group in-border">
            <input type="text" class="form-control @if($errors->has('education')) is-invalid @endif" id="education" name="education" placeholder="Please enter " value="{{ isset($volunteer->education) ? $volunteer->education : old('education') }}">
            <label for="education" class="form-label fs-5 fs-lg-1">Education </label>          
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-label-group in-border">
            <input type="text" class="form-control @if($errors->has('working_experience')) is-invalid @endif" id="workingExperience" name="working_experience" placeholder="Please enter " value="{{ isset($volunteer->working_experience) ? $volunteer->working_experience : old('working_experience') }}">
            <label for="workingExperience" class="form-label fs-5 fs-lg-1">Working Experience </label>          
        </div>
    </div>


    @if(isset($volunteer->interested_work_type))


    <div class="col-md-6 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What kind of work would you be interested in.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ContentWritingMarketing" value="Content writing & Marketing" {{ $volunteer->interested_work_type == 'Content writing & Marketing' ? 'checked' : '' }} >
                <label class="form-check-label" for="ContentWritingMarketing">
                    Content writing & Marketing
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ResearchStatistics" value="Research & Statistics" {{ $volunteer->interested_work_type == 'Research & Statistics' ? 'checked' : '' }} >
                <label class="form-check-label" for="ResearchStatistics">
                    Research & Statistics
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="BusinessConsultancy" value="Business Consultancy" {{ $volunteer->interested_work_type == 'Business Consultancy' ? 'checked' : '' }} >
                <label class="form-check-label" for="BusinessConsultancy">
                    Business Consultancy
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ConductingTrainingsCoaching" value="Conducting Trainings & Coaching" {{ $volunteer->interested_work_type == 'Conducting Trainings & Coaching' ? 'checked' : '' }} >
                <label class="form-check-label" for="ConductingTrainingsCoaching">
                    Conducting Trainings & Coaching
                </label>
            </div>


            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ProjectInvolvement" value="Project bases involvement" {{ $volunteer->interested_work_type == 'Project bases involvement' ? 'checked' : '' }} >
                <label class="form-check-label" for="ProjectInvolvement">
                    Project bases involvement
                </label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-6 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">What kind of work would you be interested in.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ContentWritingMarketing" value="Content writing & Marketing" {{ old('interested_work_type') == 'Content writing & Marketing' ? 'checked' : '' }} >
                <label class="form-check-label" for="ContentWritingMarketing">
                    Content writing & Marketing
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ResearchStatistics" value="Research & Statistics" {{ old('interested_work_type') == 'Research & Statistics' ? 'checked' : '' }} >
                <label class="form-check-label" for="ResearchStatistics">
                    Research & Statistics
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="BusinessConsultancy" value="Business Consultancy" {{ old('interested_work_type') == 'Business Consultancy' ? 'checked' : '' }} >
                <label class="form-check-label" for="BusinessConsultancy">
                    Business Consultancy
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ConductingTrainingsCoaching" value="Conducting Trainings & Coaching" {{ old('interested_work_type') == 'Conducting Trainings & Coaching' ? 'checked' : '' }} >
                <label class="form-check-label" for="ConductingTrainingsCoaching">
                    Conducting Trainings & Coaching
                </label>
            </div>


            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="interested_work_type" id="ProjectInvolvement" value="Project bases involvement" {{ old('interested_work_type') == 'Project bases involvement' ? 'checked' : '' }} >
                <label class="form-check-label" for="ProjectInvolvement">
                    Project bases involvement
                </label>
            </div>

        </div>
    </div>
    @endif





    @if(isset($volunteer->week_time_spend))


    <div class="col-md-6 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">How much time I could spend in a week.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="oneFourHours" value="1-4 Hours" {{ $volunteer->week_time_spend == '1-4 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="oneFourHours">
                    1-4 Hours
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="fiveFifteenHours" value="5-15 Hours" {{ $volunteer->week_time_spend == '5-15 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="fiveFifteenHours">
                    5-15 Hours
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="sixteenFortyHours" value="16-40 Hours" {{ $volunteer->week_time_spend == '16-40 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="sixteenFortyHours">
                    16-40 Hours
                </label>
            </div>

        </div>
    </div>

    @else

    <div class="col-md-6 col-sm-12">
        <div>
            <p class="form-label fs-6 fw-bold">How much time I could spend in a week.</p>
            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="oneFourHours" value="1-4 Hours" {{ old('week_time_spend') == '1-4 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="oneFourHours">
                    1-4 Hours
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="fiveFifteenHours" value="5-15 Hours" {{ old('week_time_spend') == '5-15 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="fiveFifteenHours">
                    5-15 Hours
                </label>
            </div>

            <div class="form-check form-radio-primary mb-3">
                <input class="form-check-input" type="radio" name="week_time_spend" id="sixteenFortyHours" value="16-40 Hours" {{ old('week_time_spend') == '16-40 Hours' ? 'checked' : '' }} >
                <label class="form-check-label" for="sixteenFortyHours">
                    16-40 Hours
                </label>
            </div>

        </div>
    </div>

    @endif

    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <textarea class="form-control" id="whyVolunteer" placeholder="Please enter" name="why_volunteer" maxlength="500"> {{ isset($volunteer) ? $volunteer->why_volunteer : old('why_volunteer') }}</textarea>
            
            <label for="whyVolunteer" class="form-label fs-5 fs-lg-1">Why I want to volunteer</label>           
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <textarea class="form-control" id="volunteeredBefore" placeholder="Please enter" name="volunteered_before" maxlength="500"> {{ isset($volunteer) ? $volunteer->volunteered_before : old('volunteered_before') }}</textarea>
            
            <label for="volunteeredBefore" class="form-label fs-5 fs-lg-1">Have you volunteered before? Please provide brief details</label>           
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <textarea class="form-control" id="anyQuestion" placeholder="Please enter" name="any_question" maxlength="500"> {{ isset($volunteer) ? $volunteer->any_question : old('any_question') }}</textarea>            
            <label for="anyQuestion" class="form-label fs-5 fs-lg-1">Do you have any question from us?</label>           
        </div>
    </div>



    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="otherdetails">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('volunteers.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>

@push('header_scripts')
@endpush
@push('footer_scripts')

@endpush


