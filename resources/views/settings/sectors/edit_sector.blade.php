<?php //echo "<pre>"; print_r($sector->toArray());die; ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Sector</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('sectors.update', $sector->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('sector_name')) is-invalid @endif"
                                id="sectorName" name="sector_name" placeholder="Please enter sector name"
                                value="{{ $sector->sector_name }}" required>
                            <label for="sectorName" class="form-label fs-5 fs-lg-1">Sector name</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('sector_name'))
                                    {{ $errors->first('sector_name') }}
                                @else
                                    sector name is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="sectorId" name="parent_id" required>
                                <option value="" >Please Select</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        @if ($sector->parent_id == $parent->id) {{ 'selected' }} @endif>
                                        {{ $parent->sector_name }}</option>
                                @endforeach
                            </select>
                            <label for="sectorId" class="form-label fs-5 fs-lg-1">Parent sector</label>
                            <div class="invalid-tooltip">Kindly select the sector name!</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="isActive" name="is_active" required>
                                <option value="" disabled >Please Select</option>
                                <option value="1" @if (trim($sector->is_active) == 'Active' ) {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if (trim($sector->is_active) == 'inactive' ) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">Kindly select the Status!</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="file" class="form-control image" id="iconName" name="icon_name" placeholder="logo" value="{{ isset($sector) ? trim($sector->icon_name) : old('icon_name') }}" accept="image/*">
                            <label for="iconName" class="form-label fs-5 fs-lg-1">Profile Picture</label>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <a href="javascript:void(0);" class="preview-img" data-url="{{ isset($sector) ? trim($sector->icon_name) : 'files/user_profiles/user-dummy-img.jpg' }}">
                            <img class="rounded-circle header-profile-user mt-1" src="{{ isset($sector) ? trim($sector->icon_name) : 'files/user_profiles/user-dummy-img.jpg' }} " alt="Header Avatar">
                        </a>
                    </div>

                   

                    <div class="col-12 text-end">
                        <input id="base64dataSector" type="hidden" name="base64data" value="">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('sectors.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('header_scripts')
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }
    .preview {
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
@endpush
@push('footer_scripts')
<script type="text/javascript">
        $("#crop").click(function() {
            $modal.modal('hide');
            canvas = cropper.getCroppedCanvas({});
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64dataSector').val(base64data);
                }
            });
        });
    </script>
@endpush