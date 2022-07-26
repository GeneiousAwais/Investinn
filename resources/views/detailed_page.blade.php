@extends('layouts.master')
@section('content')
<?php //dd($projects->toArray());?>
<?php //dd($projects->contactUs['company_name']);?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-2 flex-grow-1">Project Id: {{$projects->id}}</h4>
            <p class="card-text fs-13 fw-semibold ff-secondary float-start"> <span class="badge badge-label bg-success"><i class="mdi mdi-circle-medium"></i>
                                        {{ isset($projects->is_published) && $projects->is_published == 1 ? 'Published': 'Not ublished' }}</span>
                                    </p>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="projectSummary">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse1" aria-expanded="true" aria-controls="accor_borderedExamplecollapse1">
                                Project Summary
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="projectSummary" data-bs-parent="#accordionBordered" style="">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 border-end border-end-dashed">
                                        <h6 class="mb-2">Project Status <span class="badge badge-label bg-primary"><i class="mdi mdi-circle-medium"></i>
                                            {{$projects->project_status}}</span></h6>


                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-handshake"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Partnership Type</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->partnershipType['title']}}</h6>
                                                </div>
                                            </div>


                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-percent"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Estimated Project (IRR)</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->estimated_project_irr}}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-percent"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Estimated Economic (IRR)</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->estimated_project_irr}}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-percent"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Return on investment</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->return_on_investment}}</h6>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-4 border-end border-end-dashed">

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-heading"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Project Title</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->project_title}}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-city"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">City</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->city['city_name']}}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-calendar"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Start Date</p>
                                                    <h6 class="text-truncate mb-0">{{$projects->tentative_start_date}}</h6>
                                                </div>
                                            </div>

                                        
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-user-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Project Entrepreneur </p>
                                                    <h6 class="text-truncate mb-0">{{$projects->projectEntrepreneur['user_name']}}</h6>
                                                </div>
                                            </div>




                                        </div>
                                        <div class="col-md-4 col-sm-12 border-end border-end-dashed">

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-industry"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Sector </p>
                                                    <h6 class="text-truncate mb-0">{{ $projects->sectors['sector_name'] }}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-step-forward"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Stage </p>
                                                    <h6 class="text-truncate mb-0">{{ $projects->stages['title'] }}</h6>
                                                </div>
                                            </div>

                                            

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-clock"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Tentative Duration </p>
                                                    <h6 class="text-truncate mb-0">{{$projects->tentative_duration}} {{$projects->tentative_duration_type}}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                            

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="lab la-r-project"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Project Scale</p>
                                                    <h6 class="text-muted mb-0">{{$projects->project_scale}}</h6>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="col-md-12 col-sm-12 border-end border-end-dashed">
            
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="lab la-r-project"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Project Endorsement</p>
                                                    <h6 class="text-muted mb-0">{{$projects->project_endorsement}}</h6>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="projectSummary">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse2" aria-expanded="false" aria-controls="accor_borderedExamplecollapse2">
                                Project Details?
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="projectSummary" data-bs-parent="#accordionBordered">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Tags</p>
                                                <h6 class="text-muted mb-0">{{$projects->project_tags}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Business Case</p>
                                                <a href="{{ isset($projects) ? trim($projects->business_case) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" ><img class="rounded-circle header-profile-user mt-1" src="{{ isset($projects) ? trim($projects->business_case) : '/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar"></a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Slide Deck</p>
                                                <a href="{{ isset($projects) ? trim($projects->slide_deck) :'/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" ><img class="rounded-circle header-profile-user mt-1" src="{{ isset($projects) ? trim($projects->slide_deck) :'/files/user_profiles/user-dummy-img.jpg' }}" alt="Header Avatar"></a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Problem</p>
                                                <h6 class="text-muted mb-0">{{$projects->problem}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Market</p>
                                                <h6 class="text-muted mb-0">{{$projects->market}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Revenue Model</p>
                                                <h6 class="text-muted mb-0">{{$projects->revenue_model}}</h6>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Distribution Channel</p>
                                                <h6 class="text-muted mb-0">{{$projects->distribution_channel}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Marketing Plan</p>
                                                <h6 class="text-muted mb-0">{{$projects->marketing_plan}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Risk Challange</p>
                                                <h6 class="text-muted mb-0">{{$projects->risk_challenge}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Executive Summary</p>
                                                <h6 class="text-muted mb-0">{{$projects->executive_summary}}</h6>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">About Competition</p>
                                                <h6 class="text-muted mb-0">{{$projects->about_competition}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="projectFinancials">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse3" aria-expanded="false" aria-controls="accor_borderedExamplecollapse3">
                                Project Financials
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="projectFinancials" data-bs-parent="#accordionBordered">
                            <div class="accordion-body">
                             <div class="row">
                                 <div class="col-md-6 col-sm-12 border-end border-end-dashed">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Paid up capital </p>
                                            <h6 class="text-truncate mb-0">

                                                {{isset($projects->financials['paid_up_capital']) ? trim($projects->financials['paid_up_capital']) :'N/A'}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Raised so far </p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->financials['raised_so_far']) ? trim($projects->financials['raised_so_far']) :'N/A'}}</h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">financials </p>
                                            <h6 class="text-truncate mb-0">

                                                {{isset($projects->financials['financials']) ? trim($projects->financials['financials']) :'N/A'}}

                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Current Target to Raise </p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->financials['current_target_to_raise']) ? trim($projects->financials['current_target_to_raise']) :'N/A'}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 border-end border-end-dashed">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Previously raised </p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->financials['previously_raised']) ? trim($projects->financials['previously_raised']) :'N/A'}}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-money-bill-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Minimum investment </p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->financials['minimum_investment']) ? trim($projects->financials['minimum_investment']) :'N/A'}}

                                            </h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="lab la-r-project d-none"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Financial Document</p>
                                            <a href="{{ isset($projects->financials['financial_documents']) ? trim($projects->financials['financial_documents']) : '/files/financial_documents_files/user-dummy-img.jpg' }}" target="_blank" ><img class="rounded-circle header-profile-user mt-1" src="{{ isset($projectFinancials['financial_documents']) ? trim($projectFinancials->financials['financial_documents']) : '/files/financial_documents_files/user-dummy-img.jpg' }}" alt="Header Avatar"></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                    

                                    <div class="col-md-12 col-sm-12 border-end border-end-dashed">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Deal Offer</p>
                                                <h6 class="text-muted mb-0">

                                                    {{isset($projects->financials['deal_offer']) ? trim($projects->financials['deal_offer']) :'N/A'}}</h6>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="projectTeams">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse4" aria-expanded="false" aria-controls="accor_borderedExamplecollapse3">
                                Project Teams
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="projectTeams" data-bs-parent="#accordionBordered">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="las la-phone-volume d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Team Name</p>
                                                <h6 class="text-truncate mb-0">

                                                    {{isset($projects->teams[0]['team_name']) ? trim($projects->teams[0]['team_name']) :'N/A'}}

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="las la-phone-volume d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Team Role</p>
                                                <h6 class="text-truncate mb-0">

                                                    {{isset($projects->teams[0]['team_role']) ? trim($projects->teams[0]['team_role']) :'N/A'}}

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="las la-phone-volume d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Team Bio</p>
                                                <h6 class="text-truncate mb-0">

                                                    {{isset($projects->teams[0]['team_bio']) ? trim($projects->teams[0]['team_bio']) :'N/A'}}

                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="las la-phone-volume d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Team Overview</p>
                                                <h6 class="text-truncate mb-0">

                                                    {{isset($projects->teams[0]['team_overview']) ? trim($projects->teams[0]['team_overview']) :'N/A'}}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="projectContactUs">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse5" aria-expanded="false" aria-controls="accor_borderedExamplecollapse3">
                                Contact Us
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapse5" class="accordion-collapse collapse" aria-labelledby="projectContactUs" data-bs-parent="#accordionBordered">
                            <div class="accordion-body">
                               <div class="row">
                                <div class="col-md-6">
                                       <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-building-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">company_name</p>
                                                    <h6 class="text-truncate mb-0">

                                                    {{isset($projects->contactUs['company_name']) ? trim($projects->contactUs['company_name']) :'N/A'}}
                                                </h6>
                                                </div>
                                            </div>


                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-global-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Website</p>
                                                    <h6 class="text-truncate mb-0">


                                                    {{isset($projects->contactUs['website_link']) ? trim($projects->contactUs['website_link']) :'N/A'}}</h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="ri-user-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">Contact person</p>
                                                    <h6 class="text-truncate mb-0">

                                                    {{isset($projects->contactUs['contact_person']) ? trim($projects->contactUs['contact_person']) :'N/A'}}
                                                </h6>
                                                </div>
                                            </div>

                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                    <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                        <i class="las la-at"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="mb-1">email</p>
                                                    <h6 class="text-truncate mb-0">
                                                        {{isset($projects->contactUs['email']) ? trim($projects->contactUs['email']) :'N/A'}}</h6>
                                                </div>
                                            </div>
                                   </div>
                                   <div class="col-md-6">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-phone-volume"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Contact No</p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->contactUs['phone_no']) ? trim($projects->contactUs['phone_no']) :'N/A'}}</h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                            <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                <i class="las la-handshake d-none"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Designation</p>
                                            <h6 class="text-truncate mb-0">
                                                {{isset($projects->contactUs['designation']) ? trim($projects->contactUs['designation']) :'N/A'}}</h6>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                                                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                                                    <i class="lab la-r-project d-none"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Logo</p>
                                                <a href="{{ isset($projects->contactUs['logo']) ? trim($projects->contactUs['logo']) : '/files/user_profiles/user-dummy-img.jpg' }}" target="_blank" ><img class="rounded-circle header-profile-user mt-1" src="{{ isset($projects->contactUs['logo']) ? trim($projects->contactUs['logo']) : '/files/contact_us_files/user-dummy-img.jpg' }}" alt="Header Avatar"></a>
                                            </div>
                                        </div>

                                </div>
                               </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>

    </div>
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
@endpush

