<form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('projects.update',isset($project) ? $project->id : '') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="problem" placeholder="Please enter" name="problem"  maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->problem) : '' }} </textarea>
            <label for="problem" class="form-label fs-5 fs-lg-1">What problem do we solve?</label>
        </div>
    </div>

     <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="market" placeholder="Please enter" name="market" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->market) : '' }} </textarea>
            <label for="market" class="form-label fs-5 fs-lg-1">What is our target market? What is the market size?</label>
        </div>
    </div>

     <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="marketingPlan" placeholder="Please enter" name="marketing_plan" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->marketing_plan) : '' }} </textarea>
            <label for="marketingPlan" class="form-label fs-5 fs-lg-1">How will we reach to our target market</label>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="distributionChannel" placeholder="Please enter" name="distribution_channel" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->distribution_channel) : '' }} </textarea>
            <label for="distributionChannel" class="form-label fs-5 fs-lg-1">How will we distribute our services and products to our target market? </label>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="distributionChannel" placeholder="Please enter" name="revenue_model" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->revenue_model) : '' }} </textarea>
            <label for="revenueModel" class="form-label fs-5 fs-lg-1">How will we earn the money?</label>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="aboutCompetition" placeholder="Please enter about competition" name="about_competition" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->about_competition) : '' }} </textarea>
            <label for="aboutCompetition" class="form-label fs-5 fs-lg-1">Who is our competition</label>
        </div>
    </div>


   <div class="col-md-12 col-sm-12">
        <div class="form-label-group in-border">
            <textarea class="form-control @if($errors->has('project_scale')) is-invalid @endif" id="projectScale" placeholder="Please enter executive summary" name="project_scale" maxlength="500" spellcheck="true"> {{ isset($project) ? trim($project->project_scale) : '' }}</textarea>

            <label for="projectScale" class="form-label fs-5 fs-lg-1">Why we are different?</label>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="riskChallenge" placeholder="Please enter" name="risk_challenge" maxlength="800" spellcheck="true">{{ isset($project) ? trim($project->risk_challenge) : '' }} </textarea>
            <label for="riskChallenge" class="form-label fs-5 fs-lg-1">What are the risks & challenge</label>
        </div>
    </div>


    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="details">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>
