<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit partnership Types</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('partnership-types.update', $partnershipType->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                id="title" name="title" placeholder="Please enter partnership Types title"
                                value="{{ $partnershipType->title }}" required>
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

                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled >Please Select</option>
                                <option value="1" @if (trim($partnershipType->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($partnershipType->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                   

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('partnership-types.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
