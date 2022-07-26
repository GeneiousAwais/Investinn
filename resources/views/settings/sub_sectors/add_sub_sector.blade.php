<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Sub Sector</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('sub-sectors.store') }}" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if($errors->has('sub_sector_name')) is-invalid @endif" id="subSectorName" placeholder="Sub Sector Name" name="sub_sector_name" value="{{ old('sub_sector_name') }}" required>
                            <label for="subSectorName" class="form-label fs-5 fs-lg-1">Sub Sector Name</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('sub_sector_name'))
                                {{ $errors->first('sub_sector_name') }}
                                @else
                                Sub Sector Name is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled selected>Please Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="sectorId" name="sector_id" required>
                                <option value="" disabled selected>Please Select</option>
                                @foreach($sectors as $sector)
                                <option value="{{$sector->id}}" @if (old('sector_id')==$sector->id) {{ 'selected' }} @endif>{{$sector->sector_name}}</option>
                                @endforeach
                            </select>
                            <label for="sectorId" class="form-label fs-5 fs-lg-1">sectors List</label>
                            <div class="invalid-tooltip">Kindly select the sector name!</div>
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