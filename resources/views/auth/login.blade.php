<!doctype html>
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
    <head>
      <meta charset="utf-8" />
      <title>Sign In | Investinn - Admin & Dashboard</title>
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
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
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
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue to Investinn Admin panel.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ">
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                         @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="text-muted">{{ __('Forgot your password?') }}</a>
                                                         @endif
                                                    </div>
                                                    <label class="form-label" for="password">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5" placeholder="Enter password" id="password"  name="password">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" value="" id="remember_me">
                                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                                </div>

                                                <div class="mt-4 text-center d-none">
                                                    <div class="signin-other-title">
                                                        <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                                    </div>

                                                    <div>
                                                        <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                                        <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="mt-5 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
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

    <script type="text/javascript">

        document.getElementById("password-addon").addEventListener("click",function(){var e=document.getElementById("password");"password"===e.type?e.type="text":e.type="password"});

    </script>

</body>

</html>
