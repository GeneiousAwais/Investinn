@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1 d-none">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control border-0 dash-filter-picker shadow"
                                                        data-provider="flatpickr" data-range-date="true"
                                                        data-date-format="d M, Y"
                                                        data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                    <div class="input-group-text bg-primary border-primary text-white"><i
                                                            class="ri-calendar-2-line"></i></div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-soft-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i> Add
                                                    Product</button>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                        class="ri-pulse-line"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    

                    @if(Auth::user()->user_type_id == 1 && isset($projects))
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($sectors as $sector)
                                    <a href="{{ route('dashboard', ['sector_id' => $sector->id]) }}" class="btn btn-soft-primary waves-effect waves-light">{{$sector->sector_name}}</a>
                                @endforeach
                            </div>
                        </div>

                        @forelse ($projects as $project)
                    
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-animate">
                                    <div class="card-header">
                                        <h5 class="fs-22 fw-semibold ff-secondary "><span class="float-end"><strong>PKR {{$project->estimated_project_irr}}</strong></span></h4>
                                        <h6 class="card-title mb-0">Project: {{str_pad($project->id, 4, '0', STR_PAD_LEFT)}} </h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text fs-13 fw-semibold ff-secondary">
                                            {{$project->project_title}}<br/>{{$project->sectors->sector_name}} | {{$project->sectors->sector_name}} 
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('project-details',isset($project) ? $project->id : '') }}" class="link-success float-end">Read More <i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                                         @if(isset($projectscity->city_name))
                                        <p class="text-muted mb-0 text-start"><span class="float-start"><strong><i class="las la-map-marker"></i> {{isset($project->city->city_name) ? $project->city->city_name : ''}}</strong></span></p>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        
                        @empty
                        <div class="alert alert-primary" role="alert">
                                <strong> No record found! </strong> Please apply a diffrent filter
                            </div>
                        @endforelse
                    </div>
                    @else

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Investors
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0 d-none">
                                            <h5 class="text-success fs-14 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ isset($total_investors) ? str_pad($total_investors, 4, '0', STR_PAD_LEFT) : 0}}">0</span></h4>
                                            <a href="{{ route('shareholders.index') }}" class="text-decoration-underline">View investors</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-success rounded fs-3">
                                                <i class="bx bx-user text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Pledges</p>
                                        </div>
                                        <div class="flex-shrink-0 d-none">
                                            <h5 class="text-danger fs-14 mb-0">
                                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="">{{ isset($total_funds_pledged) ? $total_funds_pledged :'check'}}</span></h4>
                                            <a href="javascript:void(0);" class="text-decoration-underline ">View all Pledges</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Entrepreneur</p>
                                        </div>
                                        <div class="flex-shrink-0 d-none">
                                            <h5 class="text-success fs-14 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ isset($totalEntrepreneur) ? str_pad($totalEntrepreneur, 4, '0', STR_PAD_LEFT) : 0}}">0</span></h4>
                                            <a href="{{ route('entrepreneurs.index') }}" class="text-decoration-underline">See details</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                                <i class="bx bx-user-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Projects</p>
                                        </div>
                                        <div class="flex-shrink-0 d-none">
                                            <h5 class="text-muted fs-14 mb-0">
                                                +0.00 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ isset($total_projects) ? str_pad($total_projects, 4, '0', STR_PAD_LEFT) : 0}}">0</span></h4>
                                            <a href="{{ route('projects.index') }}" class="text-decoration-underline">view projects</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-primary rounded fs-3">
                                                <i class="bx bx-wallet text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div> <!-- end row-->

                    @endif



                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>

    </div>
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
@endpush

