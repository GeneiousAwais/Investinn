
@if(isset($project))
<form class="row g-3 needs-validation" id="projectsDetailsForm" novalidate method="POST" action="{{ route('projects.update',isset($project) ? $project->id : '') }}">

    @method('PATCH')
    @else
    <form class="row g-3 needs-validation" id="projectsSummaryForm" novalidate method="POST" action="{{ route('projects.store') }}">
        @endif
        @csrf

        @if(isset($project))
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_status')) is-invalid @endif" id="projectStatus" name="project_status" aria-label="Please select" required>
                    <option value="">Please select</option>
                    <option value="New" {{ $project->project_status == 'New' ? 'selected' : '' }} >New</option>
                    <option value="Submitted" {{ $project->project_status == 'Submitted' ? 'selected' : '' }} >Submitted</option>
                    <option value="Approved"  {{ $project->project_status == 'Approved' ? 'selected' : '' }} >Approved</option>
                    <option value="Returned"  {{ $project->project_status == 'Returned' ? 'selected' : '' }} >Returned</option>
                </select>
                <label for="projectStatus" class="form-label fs-5 fs-lg-1">Project Status <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">Project Status is required!</div>
            </div>
        </div>
        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_status')) is-invalid @endif" id="projectStatus" name="project_status" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    <option value="New" @if (old('project_status')== 'New') {{ 'selected' }} @endif>New</option>
                    <option value="Submitted" @if (old('project_status')== 'Submitted') {{ 'selected' }} @endif>Submitted</option>
                    <option value="Approved" @if (old('project_status')== 'Approved') {{ 'selected' }} @endif>Approved</option>
                    <option value="Returned" @if (old('project_status')== 'Returned') {{ 'selected' }} @endif>Returned</option>
                </select>
                <label for="projectStatus" class="form-label fs-5 fs-lg-1">Project Status <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('project_status'))
                    {{ $errors->first('project_status') }}
                    @else
                    Project Status is required!
                    @endif
                </div>
            </div>
        </div>
        @endif


        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <input type="text" class="form-control" id="projectTitle" name="project_title" placeholder="Please enter project title" value="{{ isset($project) ? $project->project_title : old('project_title') }}" maxlength="150">
                <label for="projectTitle" class="form-label fs-5 fs-lg-1">Project Title</label>           
            </div>
        </div>


        @if(isset($project))

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="load-select form-select @if($errors->has('sector_id')) is-invalid @endif" data-target="sub_sector_id" data-url="{{ route('list-subsectors') }}" id="sectorId" name="sector_id" aria-label="Please select" required>
                    <option value="">Please select</option>
                    @foreach($sectors as $sector)
                    <option value="{{$sector->id}}" {{ $project->sector_id == $sector->id ? 'selected' : '' }} > {{$sector->sector_name}}</option>
                    @endforeach
                </select>
                <label for="sectorId" class="form-label fs-5 fs-lg-1">Sector <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('sector_id'))
                    {{ $errors->first('sector_id') }}
                    @else
                    sector is required!
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('sub_sector_id')) is-invalid @endif" data-target="sub_sector_id" id="subSectorId" name="sub_sector_id" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    @foreach($sub_sectors as $sub_sector)
                    <option value="{{$sub_sector->id}}" {{ $project->sub_sector_id == $sub_sector->id ? 'selected' : '' }} > {{$sub_sector->sector_name}}</option>
                    @endforeach
                </select>
                <label for="subSectorId" class="form-label fs-5 fs-lg-1">Sub Sector <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">Sub Sector is required!</div>
                <div class="invalid-tooltip">
                    @if($errors->has('sub_sector_id'))
                    {{ $errors->first('sub_sector_id') }}
                    @else
                    Sub sector is required!
                    @endif
                </div>
            </div>
        </div>


        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="load-select form-select @if($errors->has('sector_id')) is-invalid @endif" data-target="sub_sector_id" data-url="{{ route('list-subsectors') }}" id="sectorId" name="sector_id" aria-label="Please select" required>
                    <option value="">Please select</option>
                    @foreach($sectors as $sector)
                    <option value="{{$sector->id}}" @if (old('sector_id')==$sector->id) {{ 'selected' }} @endif>{{$sector->sector_name}}</option>
                    @endforeach
                </select>
                <label for="sectorId" class="form-label fs-5 fs-lg-1">Sector <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('sector_id'))
                    {{ $errors->first('sector_id') }}
                    @else
                    sector is required!
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12  mt-3">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('sub_sector_id')) is-invalid @endif" id="subSectorId" name="sub_sector_id" aria-label="Sector select" required>
                    <option value="">Please select</option>
                </select>
                <label for="subSectorId" class="form-label fs-5 fs-lg-1">Sub Sector <span class="text-danger">*</span></label>
                <div class="invalid-tooltip">
                    @if($errors->has('sub_sector_id'))
                    {{ $errors->first('sub_sector_id') }}
                    @else
                    sub sector is required!
                    @endif
                </div>
            </div>
        </div>

        @endif

        

        

        @if(isset($project))

        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select" id="stageId" name="project_stage_id" aria-label="Please select">
                    <option value="">Please select</option>
                    @foreach($projectStages as $stage)
                    <option value="{{$stage->id}}" {{ $project->project_stage_id == $stage->id ? 'selected' : '' }} >{{$stage->title}}</option>
                    @endforeach
                </select>
                <label for="stageId" class="form-label fs-5 fs-lg-1">Project Stage</label>
            </div>
        </div>

        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select" id="stageId" name="project_stage_id" aria-label="Please select">
                    <option value="">Please select</option>
                    @foreach($projectStages as $stage)
                    <option value="{{$stage->id}}" @if (old('project_stage_id')==$stage->id) {{ 'selected' }} @endif>{{$stage->title}}</option>
                    @endforeach
                </select>
                <label for="stageId" class="form-label fs-5 fs-lg-1">Project Stage</label>
            </div>
        </div>
        @endif


        
        <?php /*


        <div class="col-md-4 col-sm-12 d-none">
            <div class="form-label-group in-border">
                <div class="input-group">
                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-altFormat="d M, Y" data-deafult-date="{{ date('d M, Y') }}" value="{{ old('tentative_start_date') }}" name="tentative_start_date" id="tentativeStartDate">
                    <label for="tentativeStartDate" class="form-label fs-5 fs-lg-1">Start Date</label>
                    <div class="input-group-text bg-primary border-primary text-white">
                        <i class="ri-calendar-2-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-12 d-none">
            <div class="form-label-group in-border">
                <select class="form-select" id="tentativeTurationType" name="tentative_duration_type" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    <option value="year" {{ isset($project) && $project->tentative_duration_type == 'year' ? 'selected' : '' }} >Year</option>
                    <option value="month" {{ isset($project) &&  $project->tentative_duration_type == 'month' ? 'selected' : '' }} >Month</option>
                </select>
                <label for="tentativeTurationType" class="form-label fs-5 fs-lg-1">Duration Type</label>
            </div>
        </div>
        <div class="col-md-2 col-sm-12 d-none">
            <div class="form-label-group in-border input-group">
                <input type="number" class="form-control" id="tentativeDuration" name="tentative_duration" placeholder="Please enter tentative duration" value="{{ isset($project) ? $project->tentative_duration : old('tentative_duration_days') }}">
                <label for="tentativeDuration" class="form-label fs-5 fs-lg-1">Tentative Duration</label>
            </div>
        </div>

        

        <div class="col-md-4 col-sm-12 d-none">
            <div class="form-label-group in-border input-group">
                <input type="number" class="form-control" id="estimatedEconomicIrr" name="estimated_economic_irr" placeholder="Please enter EST Economic IRR" value="{{ isset($project) ? trim($project->estimated_economic_irr) : old('estimated_economic_irr') }}">
                <div class="input-group-text">%</div>
                <label for="estimatedEconomicIrr" class="form-label fs-5 fs-lg-1">Estimated Economic (IRR)</label>
            </div>
        </div>

        

       

        <div class="col-md-4 col-sm-12 d-none">
            <div class="form-label-group in-border">
                <input type="number" class="form-control" id="projectRating" name="project_rating" placeholder="Please enter project rating" value="{{ isset($project) ? $project->project_rating : old('project_rating') }}">
                <label for="projectRating" class="form-label fs-5 fs-lg-1">Project Rating</label>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 d-none">
            <div class="form-label-group in-border">
                <input type="number" class="form-control" id="projectViews" name="project_views" placeholder="Please enter project views" value="{{ isset($project) ? $project->project_views : old('project_views') }}">
                <label for="projectViews" class="form-label fs-5 fs-lg-1">Project Views</label>
            </div>
        </div>

        */

    ?>

        

        @if(isset($project))


        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_entrepreneur')) is-invalid @endif" id="projectEntrepreneur" name="project_entrepreneur" aria-label="Sector select" required >
                    <option value="">Please select</option>
                    @foreach($entrepreneurs as $entrepreneur)
                    <option value="{{$entrepreneur->id}}" {{ $project->project_entrepreneur == $entrepreneur->id ? 'selected' : '' }}>{{$entrepreneur->name}}</option>
                    @endforeach
                </select>
                <label for="projectEntrepreneur" class="form-label fs-5 fs-lg-1">Project Entrepreneur</label>
                <div class="invalid-tooltip">
                    @if($errors->has('project_entrepreneur'))
                    {{ $errors->first('project_entrepreneur') }}
                    @else
                    Project entrepreneur is required!
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 ">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_coordinator')) is-invalid @endif" id="publishedBy" name="project_coordinator" aria-label="Please select" required>
                    <option value="">Please select</option>
                    @foreach($staffs as $staff)
                    <option value="{{$staff->id}}"{{ $project->project_coordinator == $staff->id ? 'selected' : '' }}>{{$staff->name}}</option>
                    @endforeach
                </select>
                <label for="publishedBy" class="form-label fs-5 fs-lg-1">Project Coordinates</label>
            </div>
        </div>
        
        @else

        <div class="col-md-4 col-sm-12 ">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_entrepreneur')) is-invalid @endif" id="projectEntrepreneur" name="project_entrepreneur" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    @foreach($entrepreneurs as $entrepreneur)
                    <option value="{{$entrepreneur->id}}" @if (old('project_entrepreneur')==$entrepreneur->id) {{ 'selected' }} @endif>{{$entrepreneur->name}}</option>
                    @endforeach
                </select>
                <label for="projectEntrepreneur" class="form-label fs-5 fs-lg-1">Project Entrepreneur</label>
                <div class="invalid-tooltip">
                    @if($errors->has('project_entrepreneur'))
                    {{ $errors->first('project_entrepreneur') }}
                    @else
                    Project entrepreneur is required!
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12 ">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('project_coordinator')) is-invalid @endif" id="publishedBy" name="project_coordinator" aria-label="Please select" required>
                    <option value="">Please select</option>
                    @foreach($staffs as $staff)
                    <option value="{{$staff->id}}" @if (old('project_coordinator')==$staff->id) {{ 'selected' }} @endif>{{$staff->name}}</option>
                    @endforeach
                </select>
                <label for="publishedBy" class="form-label fs-5 fs-lg-1">Project Coordinates</label>
            </div>
        </div>
        @endif

        @role('admin|staff')
        @if(isset($project))
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('is_published')) is-invalid @endif" id="isPublished" name="is_published" aria-label="Sector select">
                    <option value="">Please select</option>
                    <option value="1" {{ $project->is_published == 1 ? 'selected' : '' }} >Published</option>
                    <option value="0" {{ $project->is_published == 0 ? 'selected' : '' }} >Not published</option>
                    
                </select>
                <label for="isPublished" class="form-label fs-5 fs-lg-1">Published</label>
            </div>
        </div>
        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('is_published')) is-invalid @endif" id="isPublished" name="is_published" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    <option value="1" @if (old('is_published')== '1') {{ 'selected' }} @endif>Published</option>
                    <option value="0" @if (old('is_published')== '0') {{ 'selected' }} @endif>Not Published</option>
                </select>
                <label for="isPublished" class="form-label fs-5 fs-lg-1">Published</label>
            </div>
        </div>
        @endif
        @endrole


         @if(isset($project))
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('is_featured')) is-invalid @endif" id="isFeatured" name="is_featured" aria-label="Sector select">
                    <option value="">Please select</option>
                    <option value="1" {{ $project->is_featured == 1 ? 'selected' : '' }} >Featured</option>
                    <option value="0" {{ $project->is_featured == 0 ? 'selected' : '' }} >Not Featured</option>
                    
                </select>
                <label for="isFeatured" class="form-label fs-5 fs-lg-1">Featured</label>
            </div>
        </div>
        @else
        <div class="col-md-4 col-sm-12">
            <div class="form-label-group in-border">
                <select class="form-select @if($errors->has('is_featured')) is-invalid @endif" id="isFeatured" name="is_featured" aria-label="Sector select" required>
                    <option value="">Please select</option>
                    <option value="1" @if (old('is_featured')== '1') {{ 'selected' }} @endif>Featured</option>
                    <option value="0" @if (old('is_featured')== '0') {{ 'selected' }} @endif>Not Featured</option>
                </select>
                <label for="isFeatured" class="form-label fs-5 fs-lg-1">Featured</label>
            </div>
        </div>
        @endif

        <div class="col-md-12 col-sm-12">
            <div class="form-label-group in-border">
                <input type="text" class="form-control project_tags" id="projectTags" name="project_tags" placeholder="Only take 3 tags" value="{{ isset($project) ? trim($project->project_tags) : old('project_tags') }}" data-role="tagsinput" spellcheck="true">
                <label id="labelProjectTags" for="projectTags" class="form-label fs-5 fs-lg-1">Project Tags</label>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 mt-4">
            <div class="input-group form-label-group in-border">
                <textarea class="form-control" id="executiveSummary" placeholder="Please enter executive summary" name="executive_summary" maxlength="800" spellcheck="true" > {{ isset($project) ? trim($project->executive_summary) : '' }}</textarea>
                <label for="executiveSummary" class="form-label fs-5 fs-lg-1">Executive Summary</label>
            </div>
        </div>

         <?php /*

        <div class="col-md-12 col-sm-12 d-none">
            <div class="form-label-group in-border">

                <textarea class="form-control @if($errors->has('project_endorsement')) is-invalid @endif" id="projectEndorsement" placeholder="Please enter executive summary" name="project_endorsement" maxlength="500" spellcheck="true" > {{ isset($project) ? trim($project->project_endorsement) : '' }}</textarea>

                <label for="projectEndorsement" class="form-label fs-5 fs-lg-1">Project Endorsement</label>
            </div>
        </div>

        */?>

        <div class="col-md-12 col-sm-12">
            <div>
                <textarea class="form-control ckeditor-description" id="highlights" placeholder="Please enter" name="highlights"  maxlength="800" spellcheck="true" >{{ isset($project->highlights) ? trim($project->highlights) : '' }}</textarea>
            </div>
        </div>



        <div class="col-12 text-end">
            <input type="hidden" class="form-control" id="form_info" name="form_info"  value="summary">
            <button class="btn btn-primary" type="submit">Save Record</button>
            <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
        </div>
    </form>

    @push('header_scripts')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    @endpush
    @push('footer_scripts')

    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.querySelector('input[name=project_tags]');
        tagify = new Tagify(input, {maxTags: 3})

        $(document).ready(function() {
            $('.bootstrap-tagsinput').hide();
            $('.bootstrap-tagsinput').addClass('border-0');
            $('#labelProjectTags').hide();
        });

    </script>

    @endpush


    