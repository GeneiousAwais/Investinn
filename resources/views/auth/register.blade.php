<!doctype html>
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
      <meta charset="utf-8" />
      <title>Sign Up | Investinn - Admin & Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
      <meta content="Investinn" name="author" />
      <link rel="shortcut icon" href="{{ asset('theme/dist/default/assets/images/favicon.ico') }}">
      <script src="{{ asset('theme/dist/default/assets/js/layout.js') }}"></script>
      <link href="{{ asset('theme/dist/default/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('theme/dist/default/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('theme/dist/default/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ asset('theme/dist/default/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden m-0">
                            <div class="row justify-content-center g-0">
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            {{-- <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>
                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active"
                                                        aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1"
                                                        aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2"
                                                        aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Register Account</h5>

                                        </div>

                                        <div class="mt-4">
                                            <form class="needs-validation" method="POST" action="{{ route('register') }}" oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "Passwords do not match." : "")' autocomplete="off" novalidate >
                                                 @csrf


                                                <div class="mb-3">
                                                    <label for="name" class="form-label @if($errors->has('name')) is-invalid @endif">Complete Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required value="{{ old('name') }}">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('name'))
                                                        {{ $errors->first('name') }}
                                                        @else
                                                        Name is required!
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label @if($errors->has('email')) is-invalid @endif">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required value="{{ old('email') }}">
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('email'))
                                                        {{ $errors->first('email') }}
                                                        @else
                                                        email is required!
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="mb-2">
                                                    <label for="password" class="form-label @if($errors->has('password')) is-invalid @endif">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" min="8" required >
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('password'))
                                                        {{ $errors->first('password') }}
                                                        @else
                                                        password is required!
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="passwordConfirmation" class="form-label @if($errors->has('password_confirmation')) is-invalid @endif">Confirm Password<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="passwordConfirmation" name="password_confirmation" placeholder="confirm password" required>
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('password'))
                                                        {{ $errors->first('password') }}
                                                        @else
                                                        confirm password is required!
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="userTypeId" class="form-label @if($errors->has('user_type_id')) is-invalid @endif">User Type &nbsp;<span class="text-danger">*</span></label>
                                                    <select class="form-select" id="userTypeId" name="user_type_id" required="">
                                                        <option selected="" disabled="" value="">Please select</option>
                                                        <!-- <option value="1" @if (old('user_type_id')== 1 ) {{ 'selected' }} @endif >Investor</option>
                                                        <option value="2" @if (old('user_type_id')== 2) {{ 'selected' }} @endif>Entrepreneur</option> -->

                                                        @foreach($userTypes as $userType)
                                                        <option value="{{$userType->id}}" @if (old('user_type_id')==$userType->id) {{ 'selected' }} @endif>{{ucfirst($userType->user_name)}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        @if($errors->has('user_type_id'))
                                                        {{ $errors->first('user_type_id') }}
                                                        @else
                                                        User Type is required!
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the Investinn <a href="javascript:void(0);" class="text-primary text-decoration-underline fst-normal fw-medium">Terms of Use</a></p>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> {{ __('Already registered?') }}</a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy; <script>document.write(new Date().getFullYear())</script> Investinn. Crafted with <i class="mdi mdi-heart text-danger"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('theme/dist/default/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/libs/simplebar/simplebar.min.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/libs/node-waves/waves.min.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/libs/feather-icons/feather.min.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/js/pages/plugins/lord-icon-2.1.0.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/js/plugins.js') }} "></script>

    <script src="{{ asset('theme/dist/default/assets/js/pages/form-validation.init.js') }} "></script>
</body>

</html>
