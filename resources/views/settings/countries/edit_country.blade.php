<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Country</h4>
            <div class="flex-shrink-0 d-none">
                    <a href="{{ route('countries.index') }}" class="btn btn-sm btn-soft-success">
                        <i class="ri-add-circle-line align-middle me-1"></i> Add New Country
                    </a>
            </div>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate
                    action="{{ route('countries.update', $country->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('country_name')) is-invalid @endif"
                                id="countryName" name="country_name" placeholder="Please enter country name"
                                value="{{ $country->country_name }}" required>
                            <label for="countryName" class="form-label fs-5 fs-lg-1">Country name</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('country_name'))
                                    {{ $errors->first('country_name') }}
                                @else
                                    Country name is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" name="abbreviation" id="countryNameAbbr"
                                placeholder="Please enter abbreviation" value="{{ $country->abbreviation }}" required>
                            <label for="countryNameAbbr" class="form-label fs-5 fs-lg-1">Abbreviation</label>
                            <div class="invalid-tooltip">Abbreviation is required!</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="number" class="form-control" name="country_code" id="countryCode"
                                placeholder="Please enter country code" value="{{ $country->country_code }}" required>
                            <label for="countryCode" class="form-label fs-5 fs-lg-1">Country Code</label>
                            <div class="invalid-tooltip">Country code is required!</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" name="continent_name" id="continentName" placeholder="Please enter continent name" value="{{ $country->continent_name }}" required>
                            <label for="continentName" class="form-label fs-5 fs-lg-1">Continent Name</label>
                            <div class="invalid-tooltip">Continent Name is required!</div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('countries.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
