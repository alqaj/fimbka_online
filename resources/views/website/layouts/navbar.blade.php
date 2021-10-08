 <!-- Navbar -->
  <nav
       id="main-navbar"
       class="navbar navbar-expand-lg navbar-light bg-light fixed-top "
       >
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Brand -->
      <a class="navbar-brand" href="#">
        <img
             src="{{ asset('img/logo.png') }}"
             height="25"
             alt=""
             loading="lazy"
             />
      </a>
      <!-- Search form -->
      <!-- <form class="d-none d-md-flex input-group w-auto my-auto">
        <input
               autocomplete="off"
               type="search"
               class="form-control rounded"
               placeholder='Search (ctrl + "/" to focus)'
               style="min-width: 225px"
               />
        <span class="input-group-text border-0"
              ><i class="fas fa-search"></i
          ></span>
      </form> -->

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        @if(Auth::check())
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
             class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
             href="#"
             id="navbarDropdownMenuLink"
             role="button"
             data-mdb-toggle="dropdown"
             aria-expanded="false"
             >
             <span class="">{{ Auth::user()->name }} &nbsp</span>
             <i class="fas fa-caret-down"></i>
            <!-- <img
                 src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                 class="rounded-circle"
                 height="22"
                 alt=""
                 loading="lazy"
                 /> -->
          </a>
          <ul
              class="dropdown-menu dropdown-menu-end"
              aria-labelledby="navbarDropdownMenuLink"
              >
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li><a class="dropdown-item" href="#">Pengaturan</a></li>
            <li><a class="dropdown-item" href="{{ route('website.auth.logout') }}">Keluar</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->