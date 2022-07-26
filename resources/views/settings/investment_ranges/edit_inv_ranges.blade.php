<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Investment Ranges</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('investment-ranges.update', $investmentRange->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                id="title" name="title" placeholder="Please enter Investment Ranges title"
                                value="{{ $investmentRange->title }}" required>
                            <label for="title" class="form-label fs-5 fs-lg-1">Title</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('title'))
                                    {{ $errors->first('title') }}
                                @else
                                    Title is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border input-group">
                            <input type="number" class="form-control @if($errors->has('range_value')) is-invalid @endif" id="rangeValue" name="range_value" placeholder="Please enter" value="{{ isset($investmentRange->range_value) ? trim($investmentRange->range_value) : old('range_value') }}" required>
                            <div class="input-group-text">$</div>
                            <label for="rangeValue" class="form-label fs-5 fs-lg-1">Value</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('range_value'))
                                {{ $errors->first('range_value') }}
                                @else
                                Value is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled >Please Select</option>
                                <option value="1" @if (trim($investmentRange->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($investmentRange->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                   

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('investment-ranges.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
