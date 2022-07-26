<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Sub Sector</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('sub-sectors.update', $subSector->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('sub_sector_name')) is-invalid @endif"
                                id="subSectorName" name="sub_sector_name" placeholder="Please enter Sub sector name"
                                value="{{ $subSector->sub_sector_name }}" required>
                            <label for="subSectorName" class="form-label fs-5 fs-lg-1">Sub Sector Name</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('sub_sector_name'))
                                    {{ $errors->first('sub_sector_name') }}
                                @else
                                    Sub Sector name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled>Please Select</option>
                                <option value="1" @if (trim($subSector->is_active) == 'Active') {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($subSector->is_active) == 'inactive') {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="sectorId" name="sector_id" required>
                                <option value="" disabled >Please Select</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id }}"
                                        @if ($subSector->sector_id == $sector->id) {{ 'selected' }} @endif>
                                        {{ $sector->sector_name }}</option>
                                @endforeach
                            </select>
                            <label for="sectorId" class="form-label fs-5 fs-lg-1">sector List</label>
                            <div class="invalid-tooltip">Kindly select the sector name!</div>
                        </div>
                    </div>

                   

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('sub-sectors.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
