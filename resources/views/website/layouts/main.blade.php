<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ env('APP_NAME') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/plugins/toastr/toastr.min.css') }}">
    <style>
        .navbar-nav .nav-link {
            margin-right: 10px;
        }

        .navbar-brand img {
            height: 40px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 80px;
        }
    </style>
    @stack('styles')
</head>

<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('img/LOGO-AISIN-BLUE.png') }}" alt="Logo">

                    </a>
                </div>
            </div>
        </div>
    </header>
    @include('website.layouts.navbar')
    <main class="mt-3">
        <div class="container">
            @yield('content')
        </div>
    </main>
    {{-- <footer> --}}

    <div class="row">
        <div class="col-md-12">
            <footer class="footer text-center">
                <div class="containers">
                    <span class="text-muted fw-light">Form Izin Membawa Barang Keluar Area AIIA (FIMBKA)</span>
                    <br />
                    <span class="text-muted fw-lighter">© 2023 ITD Department AIIA. All rights reserved.</span>
                </div>
            </footer>
        </div>

    </div>
    {{-- </footer> --}}
    <script src="{{ asset('vendor/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Custom scripts -->

    @stack('scripts')
</body>
