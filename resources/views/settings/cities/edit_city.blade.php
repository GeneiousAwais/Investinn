<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit City</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('cities.update', $city->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('city_name')) is-invalid @endif"
                                id="cityName" name="city_name" placeholder="Please enter city name"
                                value="{{ $city->city_name }}" required>
                            <label for="cityName" class="form-label fs-5 fs-lg-1">City name</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('city_name'))
                                    {{ $errors->first('city_name') }}
                                @else
                                    City name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled selected>Please Select</option>
                                <option value="1" @if (trim($city->is_active) == 'Active') {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($city->is_active) == 'inactive') {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="countryId" name="country_id" required>
                                <option value="" disabled selected>Please Select</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        @if ($city->country_id == $country->id) {{ 'selected' }} @endif>
                                        {{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            <label for="countryId" class="form-label fs-5 fs-lg-1">Country List</label>
                            <div class="invalid-tooltip">Kindly select the country name!</div>
                        </div>
                    </div>

                   

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('cities.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
