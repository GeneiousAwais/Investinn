@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'personaldetails' || request()->query('tab') == 'personaldetails_edit' ? 'active' : '' }} "  data-bs-toggle="tab" href="#personalDetail" role="tab" aria-selected="true">
                            <i class="fas fa-home"></i>Personal Details
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
                        @include('employees.personal')
                    </div>

                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        @include('employees.change_password')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('header_scripts')

@endpush

@push('footer_scripts')
@endpush
