
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nama Aplikasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/plugins/fontawesome-free/css/all.min') }}.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/adminlte.min.css') }}">
</head>
<body class="bg-primary">
  <h3 class="text-white text-center mt-5">Nama Aplikasi (ADMIN)</h3>
  <center>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <img src="{{ asset('img/logo.png') }}" class=" mt-2 mb-3" width="100px"/>
          <h6 class="text-dark mb-5">Deskripsi Aplikasi Dengan Satu Kalimat Singkat</h6>
          <form action="{{ route('admin.auth.authenticate') }}" method="post" class="form mt-2">
           @csrf
           @error('email')
           <span class="text-danger">{{ $message }}</span>
           @enderror
           <div class="input-group mb-3">
             <input type="text" name="email" class="form-control" placeholder="Email">
             <div class="input-group-append">
               <div class="input-group-text">
                 <span class="fas fa-envelope"></span>
               </div>
             </div>
           </div>

           @error('password')
           <span class="text-danger">{{ $message }}</span>
           @enderror
           <div class="input-group mb-3">
             <input type="password" class="form-control" name="password" placeholder="Password">
             <div class="input-group-append">
               <div class="input-group-text">
                 <span class="fas fa-lock"></span>
               </div>
             </div>
           </div>
           @error('unauthenticate')
           <span class="text-danger">{{ $message }}</span>
           @enderror
           <div class="row">
             <div class="col-sm-8 text-dark text-left">
                 <a href="{{ route('website.auth.register') }}" class="font-weight-normal link">Daftar Sekarang</a>
             </div>
             <!-- /.col -->
             <div class="col-sm-4">
               <button type="submit" class="btn btn-light border btn-block">Masuk</button>
             </div>
             <!-- /.col -->
           </div>
         </form>
       </div>
     </div>
   </div>
 </center>

 <!-- /.login-box -->

 <!-- jQuery -->
 <script src="{{ asset('vendor/plugins/jquery/jquery.min.js') }}"></script>
 <!-- Bootstrap 4 -->
 <script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- AdminLTE App -->
 <!-- <script src="{{ asset('vendor/dist/js/adminlte.min.js') }}"></script> -->
</body>
</html>
