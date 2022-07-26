<form class="row g-3 needs-validation" id="projectsFinancialsForm" novalidate method="POST" action="{{ route('project-financials.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="paidUpCapital" name="paid_up_capital" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->paid_up_capital) : old('paid_up_capital') }}">
            <div class="input-group-text">$</div>
            <label for="paidUpCapital" class="form-label fs-5 fs-lg-1">Paid up Capital</label>
        </div>
    </div>


    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="previouslyRaised" name="previously_raised" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->previously_raised) : old('previously_raised') }}">
            <div class="input-group-text">$</div>
            <label for="previouslyRaised" class="form-label fs-5 fs-lg-1">Previously Raised</label>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="currentTargetToRaise" name="current_target_to_raise" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->current_target_to_raise) : old('current_target_to_raise') }}">
            <div class="input-group-text">$</div>
            <label for="currentTargetToRaise" class="form-label fs-5 fs-lg-1">Current Target to Raise</label>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="raisedSoFar" name="raised_so_far" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->raised_so_far) : old('raised_so_far') }}">
            <div class="input-group-text">$</div>
            <label for="raisedSoFar" class="form-label fs-5 fs-lg-1">Raised so far</label>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="minimumInvestment" name="minimum_investment" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->minimum_investment) : old('minimum_investment') }}">
            <div class="input-group-text">$</div>
            <label for="minimumInvestment" class="form-label fs-5 fs-lg-1">Minimum Investment</label>
        </div>
    </div>


    @if(isset($projectFinancials))

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select" id="dealTypeId" name="deal_type_id" aria-label="Sector select">
                <option value="">Please select</option>
                @foreach($dealTypes as $dType)
                <option value="{{$dType->id}}" {{ $projectFinancials->deal_type_id == $dType->id ? 'selected' : '' }} >{{$dType->title}}</option>
                @endforeach
            </select>
            <label for="dealTypeId" class="form-label fs-5 fs-lg-1">Deal Type</label>
        </div>
    </div>

    @else

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select" id="dealTypeId" name="deal_type_id" aria-label="Sector select">
                <option value="">Please select</option>
                @foreach($dealTypes as $dType)
                <option value="{{$dType->id}}" @if (old('deal_type_id')==$dType->id) {{ 'selected' }} @endif>{{$dType->title}}</option>
                @endforeach
            </select>
            <label for="dealTypeId" class="form-label fs-5 fs-lg-1">Deal Type</label>
        </div>
    </div>
    @endif

    <div class="col-md-4 col-sm-12 d-none">
        <div class="form-label-group in-border">
            <input type="text" class="form-control" id="financials" name="financials" placeholder="Please enter" value="{{ isset($projectFinancials) ? trim($projectFinancials->financials) : old('financials') }}" spellcheck="true">
            <label for="financials" class="form-label fs-5 fs-lg-1">Financials</label>
        </div>
    </div>


    @if(isset($projectFinancials->partnership_type_id))

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select" id="partnershipTypeId" name="partnership_type_id" aria-label="Sector select">
                <option value="">Please select</option>
                @foreach($partnershipTypes as $type)
                <option value="{{$type->id}}" {{ $projectFinancials->partnership_type_id == $type->id ? 'selected' : '' }} > {{$type->title}}</option>
                @endforeach
            </select>
            <label for="partnershipTypeId" class="form-label fs-5 fs-lg-1">Partnership Type</label>
        </div>
    </div>

    @else

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <select class="form-select" id="partnershipTypeId" name="partnership_type_id" aria-label="Sector select">
                <option value="">Please select</option>
                @foreach($partnershipTypes as $type)
                <option value="{{$type->id}}" @if (old('partnership_type_id')==$type->id) {{ 'selected' }} @endif>{{$type->title}}</option>
                @endforeach
            </select>
            <label for="partnershipTypeId" class="form-label fs-5 fs-lg-1">Partnership Type</label>
        </div>
    </div>
    @endif

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="returnOnInvestment" name="return_on_investment" placeholder="Please enter EST Economic IRR" value="{{ isset($projectFinancials->return_on_investment) ? trim($projectFinancials->return_on_investment) : old('return_on_investment') }}">
            <div class="input-group-text">%</div>
            <label for="returnOnInvestment" class="form-label fs-5 fs-lg-1">Return on investment (ROI)</label>
        </div>
    </div>



    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border input-group">
            <input type="number" class="form-control" id="estimatedProjectIrr" name="estimated_project_irr" placeholder="Please enter EST Project IRR" value="{{ isset($projectFinancials->estimated_project_irr) ? trim($projectFinancials->estimated_project_irr) : old('estimated_project_irr') }}">
            <div class="input-group-text">%</div>
            <label for="estimatedProjectIrr" class="form-label fs-5 fs-lg-1">Estimated Project (IRR)</label>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 mt-4">
        <div class="input-group form-label-group in-border">
            <textarea class="form-control" id="dealOffer" placeholder="Please enter" name="deal_offer"  maxlength="800" spellcheck="true">{{ isset($projectFinancials) ? trim($projectFinancials->deal_offer) : '' }} </textarea>
            <label for="dealOffer" class="form-label fs-5 fs-lg-1">Deal Offer</label>
        </div>
    </div>


    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="financials">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>