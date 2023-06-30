<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} Sign In Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body p-5">
                        <h5 class="card-title text-center mb-0">{{ env('APP_NAME') }}</h5>
                        <h6 class="card-title text-center text-muted mb-4">(Form Izin Membawa Barang Keluar Area AIIA)
                        </h6>
                        <hr />
                        {{-- <h5 class="card-title text-center mb-4">Sign In</h5> --}}
                        @error('unauthenticate')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <div>{{ $message }} </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @enderror
                        <form action="{{ route('website.auth.authenticate') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center mb-5">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Masuk
                                    <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </div>
                            <div class="text-center mt-4">
                                <hr />
                                <span class="text-muted fw-lighter">© 2023 ITD Department AIIA. All rights
                                    reserved.</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
