<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="shortcut icon" href="{{ asset('template/assets/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
</head>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">

                            <div class="brand-logo">
                                <img src="{{ asset('template/assets/images/logo.svg') }}">
                            </div>

                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>

                            <!-- Session Status -->
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email -->
                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        placeholder="Email"
                                        value="{{ old('email') }}"
                                        required autofocus>

                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        placeholder="Password"
                                        required>

                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember -->
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember">
                                            Keep me signed in
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="auth-link text-primary">
                                        Forgot password?
                                    </a>
                                    @endif
                                </div>

                                <!-- Button -->
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        LOGIN
                                    </button>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account?
                                    <a href="{{ route('register') }}" class="text-primary">Create</a>
                                </div>

                                <div class="text-center mt-4">
                                    <span class="text-muted">atau</span>
                                </div>

                                <div class="mt-3 d-grid">
                                    <a href="{{ route('google.login') }}"
                                        class="btn btn-danger btn-lg btn-block">
                                        <i class="fa fa-google"></i> Login dengan Google
                                    </a>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('template/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('template/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('template/assets/js/misc.js') }}"></script>
    <script src="{{ asset('template/assets/js/settings.js') }}"></script>
    <script src="{{ asset('template/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('template/assets/js/jquery.cookie.js') }}"></script>

</body>

</html>