<form class="row g-3 needs-validation" id="projectsFinancialsForm" novalidate method="POST" action="{{ route('project-documents.store')}}?project_id={{isset($project) ? $project->id : ''}}" enctype="multipart/form-data">
    @csrf


    <div class="col-md-5 col-sm-12">
        <div class="form-label-group in-border">
            <input type="file" class="form-control" id="businessCase" name="business_case" placeholder="logo" value="{{ isset($projectDocuments->business_case) ? trim($projectDocuments->business_case) : old('business_case') }}" accept="image/*">
            <label for="businessCase" class="form-label fs-5 fs-lg-1">Business Case</label>
        </div>
    </div>
    <?php
    $business_case = isset($projectDocuments->business_case) ? trim($projectDocuments->business_case): '/files/user_profiles/user-dummy-img.jpg';
    $bc_path = $business_case;
    if (str_contains($business_case, 'pdf')) {
        $bc_path = '/files/blogs/doc.png';
    } 
    ?>

    <div class="col-md-1 col-sm-12">
        <a href="{{ isset($projectDocuments->business_case) ? trim($business_case) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" >
            <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($projectDocuments->business_case) ? trim($bc_path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
        </a>
    </div>
    
    <div class="col-md-5 col-sm-12">
        <div class="form-label-group in-border">
            <input type="file" class="form-control" id="slideDeck" name="slide_deck" placeholder="logo" value="{{ isset($projectDocuments->slide_deck) ? trim($projectDocuments->slide_deck) : old('slide_deck') }} " accept="image/*">
            <label for="slideDeck" class="form-label fs-5 fs-lg-1">Slide Deck</label>
        </div>
    </div>

    <?php

    $slide_deck = isset($projectDocuments->slide_deck) ? trim($projectDocuments->slide_deck): '/files/user_profiles/user-dummy-img.jpg';
    $sd_path = $slide_deck;
    if (str_contains($slide_deck, 'pdf')) {
        $sd_path = '/files/blogs/doc.png';
    } 
    ?>

    <div class="col-md-1 col-sm-12">
        <a href="{{ isset($projectDocuments->slide_deck) ? trim($slide_deck) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" >
            <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($projectDocuments->slide_deck) ? trim($sd_path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
        </a>
    </div>



    <div class="col-md-5 col-sm-12">
        <div class="form-label-group in-border">
            <input type="file" class="form-control" id="financialDocuments" name="financial_documents" placeholder="logo" value="{{ old('logo') }}" accept="image/*">
            <label for="financialDocuments" class="form-label fs-5 fs-lg-1">Financial Document</label>
        </div>
    </div>


    <?php

    $financial_documents = isset($projectDocuments->financial_documents) ? trim($projectDocuments->financial_documents): '/files/user_profiles/user-dummy-img.jpg';
    $fd_path = $financial_documents;
    if (str_contains($financial_documents, 'pdf')) {
        $fd_path = '/files/blogs/doc.png';
    } 
    ?>

    <div class="col-md-1 col-sm-12">
        <a href="{{ isset($projectDocuments->financial_documents) ? trim($financial_documents) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" >
            <img class="rounded avatar-xs header-profile-user mt-1" src="{{ isset($projectDocuments->financial_documents) ? trim($fd_path) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar">
        </a>
    </div>

    <div class="col-12 text-end">
        <input type="hidden" class="form-control" id="form_info" name="form_info"  value="documents">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('projects.index') }}" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>