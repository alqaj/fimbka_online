<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Nama Aplikasi</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('vendor/mdbootstrap/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/plugins/toastr/toastr.min.css') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('vendor/mdbootstrap/css/style.css') }}" />
    @stack('styles')
</head>
<body>
    <header>
        @include('website.layouts.sidebar')

        @include('website.layouts.navbar')
    </header>
    <main style="margin-top: 58px">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>
    <script src="{{ asset('vendor/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/mdbootstrap/js/mdb.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/toastr/toastr.min.js') }}"></script>
    <!-- Custom scripts -->
    
    @stack('scripts')
</body>