<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-6 mx-auto">
                    <div class="auth-form-light text-center p-5">

                        <h1 class="mb-3 text-gradient-primary">
                            Sistem Perpustakaan
                        </h1>

                        <p class="font-weight-light mb-4">
                            Aplikasi manajemen buku dan kategori
                        </p>

                        @auth
                            <a href="{{ route('dashboard') }}" 
                               class="btn btn-gradient-primary btn-lg">
                                Dashboard
                            </a>
                        @else
                            <div class="d-grid gap-3">
                                <a href="{{ route('login') }}" 
                                   class="btn btn-gradient-primary btn-lg">
                                    Login
                                </a>

                                <a href="{{ route('register') }}" 
                                   class="btn btn-outline-primary btn-lg">
                                    Register
                                </a>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Purple Admin JS -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

</body>
</html>