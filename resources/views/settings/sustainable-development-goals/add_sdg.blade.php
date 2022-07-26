<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Sustainable Development Goal(SDG) </h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('sustainable-development-goals.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if($errors->has('sdg_name')) is-invalid @endif" id="sdgName" placeholder="Enter name" name="sdg_name" value="{{ old('sdg_name') }}" required>
                            <label for="sdgName" class="form-label fs-5 fs-lg-1">SDG name</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('sdg_name'))
                                {{ $errors->first('sdg_name') }}
                                @else
                                SDG name is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3 @if($errors->has('is_active')) is-invalid @endif" id="isActive" name="is_active" required>
                                <option value="" disabled selected>Please Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('is_active'))
                                {{ $errors->first('is_active') }}
                                @else
                                Kindly select the Status!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="file" class="form-control image" id="iconName" name="icon_name" placeholder="logo" value="{{ isset($sdg) ? trim($sdg->icon_name) : old('icon_name') }}" accept="image/*">
                            <label for="iconName" class="form-label fs-5 fs-lg-1">Icon</label>
                        </div>
                    </div>
        
                    <div class="col-12 text-end">
                        <input id="base64dataSDG" type="hidden" name="base64data" value="">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('sustainable-development-goals.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
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
                    $('#base64dataSDG').val(base64data);
                }
            });
        });
    </script>
@endpush
