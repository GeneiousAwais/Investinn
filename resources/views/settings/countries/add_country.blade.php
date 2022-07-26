<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Country</h4>
        </div>

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('countries.store') }}" method="post">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if($errors->has('country_name')) is-invalid @endif" id="countryName" name="country_name" placeholder="Please enter country name" value="{{ old('country_name') }}" required>
                            <label for="countryName" class="form-label fs-5 fs-lg-1">Country name</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('country_name'))
                                {{ $errors->first('country_name') }}
                                @else
                                Country name is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" name="abbreviation" id="countryNameAbbr" placeholder="Please enter abbreviation" value="{{ old('abbreviation') }}" required>
                            <label for="countryNameAbbr" class="form-label fs-5 fs-lg-1">Abbreviation</label>
                            <div class="invalid-tooltip">Country name abbreviation is required!</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="number" class="form-control" name="country_code" id="countryCode" placeholder="Please enter country code" value="{{ old('country_code') }}" required>
                            <label for="countryCode" class="form-label fs-5 fs-lg-1">Country Code</label>
                            <div class="invalid-tooltip">Country code is required!</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" name="continent_name" id="continentName" placeholder="Please enter continent name" value="{{ old('continent_name') }}" required>
                            <label for="continentName" class="form-label fs-5 fs-lg-1">Continent Name</label>
                            <div class="invalid-tooltip">Continent Name is required!</div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <button type="button" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>