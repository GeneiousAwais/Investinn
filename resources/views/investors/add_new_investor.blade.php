@extends('layouts.master')
@section('content')
@include('components.flash_message')
<div class="row">
	<div class="col-xxl-12">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"> <i class="fas fa-home"></i> Personal Details </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab"> <i class="far fa-user"></i> Change Password </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab"> <i class="far fa-envelope"></i> Experience </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab"> <i class="far fa-envelope"></i> Privacy Policy </a>
					</li>
				</ul>
			</div>
			<div class="card-body p-4">
				<div class="tab-content">
					<div class="tab-pane active" id="personalDetails" role="tabpanel">
						<form action="javascript:void(0);">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-label-group in-border">
										<input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" name="name" placeholder="Please enter first name" value="{{ old('name') }}" required>
										<label for="name" class="form-label fs-5 fs-lg-1">Name</label>
										<div class="invalid-tooltip">
											@if($errors->has('name'))
											{{ $errors->first('name') }}
											@else
											name is required!
											@endif
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-label-group in-border">
										<input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" placeholder="Please enter email" value="{{ old('email') }}" required>
										<label for="email" class="form-label fs-5 fs-lg-1">Email</label>
										<div class="invalid-tooltip">
											@if($errors->has('email'))
											{{ $errors->first('email') }}
											@else
											Email is required!
											@endif
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-label-group in-border">
										<select class="form-select mb-3" id="isActive" name="is_active" required>
											<option value="" disabled selected>Please Select</option>
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
										<label for="isActive" class="form-label fs-5 fs-lg-1">Status</label>
										<div class="invalid-tooltip">Kindly select the Status!</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-label-group in-border">
										<select class="form-select @if($errors->has('experty_id')) is-invalid @endif" id="expertyId" name="experty_id" aria-label="Sector select" required>
											<option value="">Please select</option>
											@foreach($expertises as $experty)
											<option value="{{$experty->id}}" @if (old('experty_id')==$experty->id) {{ 'selected' }} @endif>{{$experty->title}}</option>
											@endforeach
										</select>
										<label for="expertyId" class="form-label fs-5 fs-lg-1">Experties</label>
										<div class="invalid-tooltip">
											@if($errors->has('experty_id'))
											{{ $errors->first('experty_id') }}
											@else
											experties is required!
											@endif
										</div>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-label-group in-border">
										<select class="form-select @if($errors->has('sector_id')) is-invalid @endif" id="sectorId" name="sector_id" aria-label="Sector select" required>
											<option value="">Please select</option>
											@foreach($sectors as $sector)
											<option value="{{$sector->id}}" @if (old('sector_id')==$sector->id) {{ 'selected' }} @endif>{{$sector->sector_name}}</option>
											@endforeach
										</select>
										<label for="sectorId" class="form-label fs-5 fs-lg-1">Sector</label>
										<div class="invalid-tooltip">
											@if($errors->has('sector_id'))
											{{ $errors->first('sector_id') }}
											@else
											sector is required!
											@endif
										</div>
									</div>
								</div>


								<div class="col-lg-6">
									<div class="mb-3">
										<label for="designationInput" class="form-label fs-5 fs-lg-1">Designation</label>
										<input type="text" class="form-control" id="designationInput" placeholder="Designation" value="Lead Designer / Developer"> </div>
								</div>
								<div class="col-lg-6">
									<div class="mb-3">
										<label for="websiteInput1" class="form-label fs-5 fs-lg-1">Website</label>
										<input type="text" class="form-control" id="websiteInput1" placeholder="www.example.com" value="www.velzon.com" /> </div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label for="cityInput" class="form-label fs-5 fs-lg-1">City</label>
										<input type="text" class="form-control" id="cityInput" placeholder="City" value="California" /> </div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label for="countryInput" class="form-label fs-5 fs-lg-1">Country</label>
										<input type="text" class="form-control" id="countryInput" placeholder="Country" value="United States" /> </div>
								</div>
								<div class="col-lg-4">
									<div class="mb-3">
										<label for="zipcodeInput" class="form-label fs-5 fs-lg-1">Zip Code</label>
										<input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput" placeholder="Enter zipcode" value="90011"> </div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3 pb-2">
										<label for="exampleFormControlTextarea" class="form-label fs-5 fs-lg-1">Description</label>
										<textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3">Hi I'm Anna Adame,It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.</textarea>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="hstack gap-2 justify-content-end">
										<button type="submit" class="btn btn-primary">Updates</button>
										<button type="button" class="btn btn-soft-success">Cancel</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="changePassword" role="tabpanel">
						<form action="javascript:void(0);">
							<div class="row g-2">
								<div class="col-lg-4">
									<div>
										<label for="oldpasswordInput" class="form-label fs-5 fs-lg-1">Old Password*</label>
										<input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password"> </div>
								</div>
								<div class="col-lg-4">
									<div>
										<label for="newpasswordInput" class="form-label fs-5 fs-lg-1">New Password*</label>
										<input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password"> </div>
								</div>
								<div class="col-lg-4">
									<div>
										<label for="confirmpasswordInput" class="form-label fs-5 fs-lg-1">Confirm Password*</label>
										<input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password"> </div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3"> <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a> </div>
								</div>
								<div class="col-lg-12">
									<div class="text-end">
										<button type="submit" class="btn btn-success">Change Password</button>
									</div>
								</div>
							</div>
						</form>
						<div class="mt-4 mb-3 border-bottom pb-2">
							<div class="float-end"> <a href="javascript:void(0);" class="link-primary">All Logout</a> </div>
							<h5 class="card-title">Login History</h5> </div>
						<div class="d-flex align-items-center mb-3">
							<div class="flex-shrink-0 avatar-sm">
								<div class="avatar-title bg-light text-primary rounded-3 fs-18"> <i class="ri-smartphone-line"></i> </div>
							</div>
							<div class="flex-grow-1 ms-3">
								<h6>iPhone 12 Pro</h6>
								<p class="text-muted mb-0">Los Angeles, United States - March 16 at 2:47PM</p>
							</div>
							<div> <a href="javascript:void(0);">Logout</a> </div>
						</div>
						<div class="d-flex align-items-center mb-3">
							<div class="flex-shrink-0 avatar-sm">
								<div class="avatar-title bg-light text-primary rounded-3 fs-18"> <i class="ri-tablet-line"></i> </div>
							</div>
							<div class="flex-grow-1 ms-3">
								<h6>Apple iPad Pro</h6>
								<p class="text-muted mb-0">Washington, United States - November 06 at 10:43AM</p>
							</div>
							<div> <a href="javascript:void(0);">Logout</a> </div>
						</div>
						<div class="d-flex align-items-center mb-3">
							<div class="flex-shrink-0 avatar-sm">
								<div class="avatar-title bg-light text-primary rounded-3 fs-18"> <i class="ri-smartphone-line"></i> </div>
							</div>
							<div class="flex-grow-1 ms-3">
								<h6>Galaxy S21 Ultra 5G</h6>
								<p class="text-muted mb-0">Conneticut, United States - June 12 at 3:24PM</p>
							</div>
							<div> <a href="javascript:void(0);">Logout</a> </div>
						</div>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0 avatar-sm">
								<div class="avatar-title bg-light text-primary rounded-3 fs-18"> <i class="ri-macbook-line"></i> </div>
							</div>
							<div class="flex-grow-1 ms-3">
								<h6>Dell Inspiron 14</h6>
								<p class="text-muted mb-0">Phoenix, United States - July 26 at 8:10AM</p>
							</div>
							<div> <a href="javascript:void(0);">Logout</a> </div>
						</div>
					</div>
					<div class="tab-pane" id="experience" role="tabpanel">
						<form>
							<div id="newlink">
								<div id="1">
									<div class="row">
										<div class="col-lg-12">
											<div class="mb-3">
												<label for="jobTitle" class="form-label fs-5 fs-lg-1">Job Title</label>
												<input type="text" class="form-control" id="jobTitle" placeholder="Job title" value="Lead Designer / Developer"> </div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="companyName" class="form-label fs-5 fs-lg-1">Company Name</label>
												<input type="text" class="form-control" id="companyName" placeholder="Company name" value="Themesbrand"> </div>
										</div>
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="experienceYear" class="form-label fs-5 fs-lg-1">Experience Years</label>
												<div class="row">
													<div class="col-lg-5">
														<select class="form-control" data-choices data-choices-search-false name="experienceYear" id="experienceYear">
															<option value="">Select years</option>
															<option value="Choice 1">2001</option>
															<option value="Choice 2">2002</option>
															<option value="Choice 3">2003</option>
															<option value="Choice 4">2004</option>
															<option value="Choice 5">2005</option>
															<option value="Choice 6">2006</option>
															<option value="Choice 7">2007</option>
															<option value="Choice 8">2008</option>
															<option value="Choice 9">2009</option>
															<option value="Choice 10">2010</option>
															<option value="Choice 11">2011</option>
															<option value="Choice 12">2012</option>
															<option value="Choice 13">2013</option>
															<option value="Choice 14">2014</option>
															<option value="Choice 15">2015</option>
															<option value="Choice 16">2016</option>
															<option value="Choice 17" selected>2017</option>
															<option value="Choice 18">2018</option>
															<option value="Choice 19">2019</option>
															<option value="Choice 20">2020</option>
															<option value="Choice 21">2021</option>
															<option value="Choice 22">2022</option>
														</select>
													</div>
													<div class="col-auto align-self-center"> to </div>
													<div class="col-lg-5">
														<select class="form-control" data-choices data-choices-search-false name="choices-single-default2">
															<option value="">Select years</option>
															<option value="Choice 1">2001</option>
															<option value="Choice 2">2002</option>
															<option value="Choice 3">2003</option>
															<option value="Choice 4">2004</option>
															<option value="Choice 5">2005</option>
															<option value="Choice 6">2006</option>
															<option value="Choice 7">2007</option>
															<option value="Choice 8">2008</option>
															<option value="Choice 9">2009</option>
															<option value="Choice 10">2010</option>
															<option value="Choice 11">2011</option>
															<option value="Choice 12">2012</option>
															<option value="Choice 13">2013</option>
															<option value="Choice 14">2014</option>
															<option value="Choice 15">2015</option>
															<option value="Choice 16">2016</option>
															<option value="Choice 17">2017</option>
															<option value="Choice 18">2018</option>
															<option value="Choice 19">2019</option>
															<option value="Choice 20" selected>2020</option>
															<option value="Choice 21">2021</option>
															<option value="Choice 22">2022</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="mb-3">
												<label for="jobDescription" class="form-label fs-5 fs-lg-1">Job Description</label>
												<textarea class="form-control" id="jobDescription" rows="3" placeholder="Enter description">You always want to make sure that your fonts work well together and try to limit the number of fonts you use to three or less. Experiment and play around with the fonts that you already have in the software you're working with reputable font websites. </textarea>
											</div>
										</div>
										<div class="hstack gap-2 justify-content-end"> <a class="btn btn-success" href="javascript:deleteEl(1)">Delete</a> </div>
									</div>
								</div>
							</div>
							<div id="newForm" style="display: none;"> </div>
							<div class="col-lg-12">
								<div class="hstack gap-2">
									<button type="submit" class="btn btn-success">Update</button> <a href="javascript:new_link()" class="btn btn-primary">Add New</a> </div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="privacy" role="tabpanel">
						<div class="mb-4 pb-2">
							<h5 class="card-title text-decoration-underline mb-3">Security:</h5>
							<div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
								<div class="flex-grow-1">
									<h6 class="fs-14 mb-1">Two-factor Authentication</h6>
									<p class="text-muted">Two-factor authentication is an enhanced security meansur. Once enabled, you'll be required to give two types of identification when you log into Google Authentication and SMS are Supported.</p>
								</div>
								<div class="flex-shrink-0 ms-sm-3"> <a href="javascript:void(0);" class="btn btn-sm btn-primary">Enable Two-facor Authentication</a> </div>
							</div>
							<div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
								<div class="flex-grow-1">
									<h6 class="fs-14 mb-1">Secondary Verification</h6>
									<p class="text-muted">The first factor is a password and the second commonly includes a text with a code sent to your smartphone, or biometrics using your fingerprint, face, or retina.</p>
								</div>
								<div class="flex-shrink-0 ms-sm-3"> <a href="javascript:void(0);" class="btn btn-sm btn-primary">Set up secondary method</a> </div>
							</div>
							<div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
								<div class="flex-grow-1">
									<h6 class="fs-14 mb-1">Backup Codes</h6>
									<p class="text-muted mb-sm-0">A backup code is automatically generated for you when you turn on two-factor authentication through your iOS or Android Twitter app. You can also generate a backup code on twitter.com.</p>
								</div>
								<div class="flex-shrink-0 ms-sm-3"> <a href="javascript:void(0);" class="btn btn-sm btn-primary">Generate backup codes</a> </div>
							</div>
						</div>
						<div class="mb-3">
							<h5 class="card-title text-decoration-underline mb-3">Application Notifications:</h5>
							<ul class="list-unstyled mb-0">
								<li class="d-flex">
									<div class="flex-grow-1">
										<label for="directMessage" class="form-check-label fs-14">Direct messages</label>
										<p class="text-muted">Messages from people you follow</p>
									</div>
									<div class="flex-shrink-0">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="directMessage" checked /> </div>
									</div>
								</li>
								<li class="d-flex mt-2">
									<div class="flex-grow-1">
										<label class="form-check-label fs-14" for="desktopNotification"> Show desktop notifications </label>
										<p class="text-muted">Choose the option you want as your default setting. Block a site: Next to "Not allowed to send notifications," click Add.</p>
									</div>
									<div class="flex-shrink-0">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="desktopNotification" checked /> </div>
									</div>
								</li>
								<li class="d-flex mt-2">
									<div class="flex-grow-1">
										<label class="form-check-label fs-14" for="emailNotification"> Show email notifications </label>
										<p class="text-muted"> Under Settings, choose Notifications. Under Select an account, choose the account to enable notifications for. </p>
									</div>
									<div class="flex-shrink-0">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="emailNotification" /> </div>
									</div>
								</li>
								<li class="d-flex mt-2">
									<div class="flex-grow-1">
										<label class="form-check-label fs-14" for="chatNotification"> Show chat notifications </label>
										<p class="text-muted">To prevent duplicate mobile notifications from the Gmail and Chat apps, in settings, turn off Chat notifications.</p>
									</div>
									<div class="flex-shrink-0">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="chatNotification" /> </div>
									</div>
								</li>
								<li class="d-flex mt-2">
									<div class="flex-grow-1">
										<label class="form-check-label fs-14" for="purchaesNotification"> Show purchase notifications </label>
										<p class="text-muted">Get real-time purchase alerts to protect yourself from fraudulent charges.</p>
									</div>
									<div class="flex-shrink-0">
										<div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" role="switch" id="purchaesNotification" /> </div>
									</div>
								</li>
							</ul>
						</div>
						<div>
							<h5 class="card-title text-decoration-underline mb-3">Delete This Account:</h5>
							<p class="text-muted">Go to the Data & Privacy section of your profile Account. Scroll to "Your data & privacy options." Delete your Profile Account. Follow the instructions to delete your account :</p>
							<div>
								<input type="password" class="form-control" id="passwordInput" placeholder="Enter your password" value="make@321654987" style="max-width: 265px;"> </div>
							<div class="hstack gap-2 mt-3"> <a href="javascript:void(0);" class="btn btn-soft-danger">Close & Delete This Account</a> <a href="javascript:void(0);" class="btn btn-light">Cancel</a> </div>
						</div>
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