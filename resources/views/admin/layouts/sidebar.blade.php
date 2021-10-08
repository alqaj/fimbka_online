<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional) -->

  @if(Auth::check())
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
     <!--  <img src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
   </div>
   <div class="info text-white">
    <i class="fas fa-user-circle"></i> <span class="align-center ml-2">{{ Auth::user()->name }}</span>
  </div>
</div>
@endif

<!-- Sidebar Menu -->
@if(Auth::user())
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('admin.home') }}" class="nav-link {{ (Route::is('admin.home') ? 'active' : '') }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Beranda
        </p>
      </a>
    </li>
  </ul>
</nav>
@endif
<!-- /.sidebar-menu -->
</div>
    <!-- /.sidebar -->