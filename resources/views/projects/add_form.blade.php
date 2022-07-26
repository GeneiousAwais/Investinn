@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1 text-primary">
                    {{ isset($project) ? ucfirst($project->project_title) : 'Create New Project' }} 
                </h4>
            </div>
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'summary' || request()->query('tab') == 'summary_edit' ? 'active' : '' }} "  data-bs-toggle="tab" href="#projectSummary" role="tab" aria-selected="true">
                            <i class="fas fa-home"></i>Summary
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'details' ? 'active' : '' }} " data-bs-toggle="tab" href="#projectDetails" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Details
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'financials' ? 'active' : '' }} " data-bs-toggle="tab" href="#projectFinancials" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Financials   
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'teams' ? 'active' : '' }} " data-bs-toggle="tab" href="#projectTeam" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Team   
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'contact_us' ? 'active' : '' }} " data-bs-toggle="tab" href="#contactUs" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Contact Us   
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'photos' ? 'active' : '' }} " data-bs-toggle="tab" href="#photosVideos" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Photos 
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'location' ? 'active' : '' }} " data-bs-toggle="tab" href="#potentialLocation" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Location  
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'investments' ? 'active' : '' }} " data-bs-toggle="tab" href="#investments" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-envelope"></i>
                            Investments
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'mentors' ? 'active' : '' }} " data-bs-toggle="tab" href="#mentors" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Mentor
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'sdgs' ? 'active' : '' }} " data-bs-toggle="tab" href="#sdg" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            SDG
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'documents' ? 'active' : '' }} " data-bs-toggle="tab" href="#documents" role="tab" aria-selected="false" {{ request()->query('tab') == 'summary' ? 'disabled' : '' }}>
                            <i class="far fa-file"></i>
                            Documents
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane {{ request()->query('tab') == 'summary' || request()->query('tab') == 'summary_edit' ? 'active' : '' }} " id="projectSummary" role="tabpanel">
                        @include('projects.project_summary')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'details' ? 'active' : '' }} " id="projectDetails" role="tabpanel">
                        @include('projects.project_details')
                    </div>
                    
                    <div class="tab-pane {{ request()->query('tab') == 'financials' ? 'active' : '' }} " id="projectFinancials" role="tabpanel">
                        @include('projects.project_financials')
                    </div>
                    
                    <div class="tab-pane {{ request()->query('tab') == 'teams' ? 'active' : '' }} " id="projectTeam" role="tabpanel">
                        @include('projects.project_teams')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'contact_us' ? 'active' : '' }} " id="contactUs" role="tabpanel">
                        @include('projects.project_contact_us')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'photos' ? 'active' : '' }} " id="photosVideos" role="tabpanel">
                        @include('projects.photos_and_videos')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'location' ? 'active' : '' }} " id="potentialLocation" role="tabpanel">
                        @include('projects.project_potential_location')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'investments' ? 'active' : '' }} " id="investments" role="tabpanel">
                        @include('projects.project_investments')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'mentors' ? 'active' : '' }} " id="mentors" role="tabpanel">
                        @include('projects.project_mentors')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'sdgs' ? 'active' : '' }} " id="sdg" role="tabpanel">
                        @include('projects.project_sdgs')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'documents' ? 'active' : '' }} " id="documents" role="tabpanel">
                        @include('projects.project_documents')
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
