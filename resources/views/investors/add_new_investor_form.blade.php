@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1 text-primary">
                    {{ isset($user_info) ? ucfirst($user_info->name) : 'Create New Investor' }} 
                </h4>
            </div>

            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'personaldetails' || request()->query('tab') == 'personaldetails_edit' ? 'active' : '' }} "  data-bs-toggle="tab" href="#personalDetail" role="tab" aria-selected="true">
                            <i class="fas fa-home"></i>Personal Details
                        </a>
                    </li>

                    

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'otherdetails' ? 'active' : '' }} " data-bs-toggle="tab" href="#otherDetails" role="tab" aria-selected="false" {{ request()->query('tab') == 'personaldetails' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Other Details
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'sectors' ? 'active' : '' }} " data-bs-toggle="tab" href="#sectorsInfo" role="tab" aria-selected="false" {{ request()->query('tab') == 'personaldetails' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Sector & Sub Sectors
                        </a>
                    </li>

                    

                    <li class="nav-item {{request()->query('tab') == 'mentors' ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="tab" href="#mentorsProject" role="tab" aria-selected="false" {{ request()->query('tab') == 'personaldetails' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Mentor
                        </a>
                    </li>

                    <li class="nav-item {{request()->query('tab') == 'investments' ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="tab" href="#investments" role="tab" aria-selected="false" {{ request()->query('tab') == 'personaldetails' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            Investments
                        </a>
                    </li>

                    <li class="nav-item {{request()->query('tab') == 'sdgs' ? 'active' : '' }}">
                        <a class="nav-link" data-bs-toggle="tab" href="#sdg" role="tab" aria-selected="false" {{ request()->query('tab') == 'personaldetails' ? 'disabled' : '' }}>
                            <i class="far fa-user"></i>
                            SDG
                        </a>
                    </li>

                    <li class="nav-item {{request()->query('tab') == 'personaldetails' ? 'd-none' : '' }}">
                        <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false">
                            <i class="far fa-user"></i>
                            Change Password
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane {{ request()->query('tab') == 'personaldetails' || request()->query('tab') == 'personaldetails_edit' ? 'active' : '' }} " id="personalDetail" role="tabpanel">
                        @include('investors.personal_details')
                    </div>
                    
                    <div class="tab-pane {{ request()->query('tab') == 'otherdetails' ? 'active' : '' }} " id="otherDetails" role="tabpanel">
                        @include('investors.other_details')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'sectors' ? 'active' : '' }} " id="sectorsInfo" role="tabpanel">
                        @include('investors.sectors_and_subsector')
                    </div>

                    

                    <div class="tab-pane {{ request()->query('tab') == 'mentors' ? 'active' : '' }} " id="mentorsProject" role="tabpanel">
                        @include('investors.mentors')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'investments' ? 'active' : '' }} " id="investments" role="tabpanel">
                        @include('investors.investments')
                    </div>

                    <div class="tab-pane {{ request()->query('tab') == 'sdgs' ? 'active' : '' }} " id="sdg" role="tabpanel">
                        @include('investors.sdgs')
                    </div>

                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        @include('investors.change_password')
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
