<nav class="navbar navbar-expand-lg navbar-light bg-light border">
    <div class="container-fluid container">
        <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('website.izin.create') }}">Buat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('website.izin.show') }}">History</a>
                </li>
                @canany(['spv_app', 'mgr_app', 'ga_app', 'itd_app'])
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Approval
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @can('spv_app')
                                <li><a class="dropdown-item"
                                        href="{{ route('website.izin.show_approval', ['link' => 'spv']) }}">Supervisor</a></li>
                            @endcan
                            @can('mgr_app')
                                <li><a class="dropdown-item"
                                        href="{{ route('website.izin.show_approval', ['link' => 'mgr']) }}">Manager</a></li>
                            @endcan
                            @can('ga_app')
                                <li><a class="dropdown-item"
                                        href="{{ route('website.izin.show_approval', ['link' => 'ga']) }}">GA</a></li>
                            @endcan
                            @can('itd_app')
                                <li><a class="dropdown-item"
                                        href="{{ route('website.izin.show_approval', ['link' => 'itd']) }}">ITD</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @can('confirm')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('website.izin.show_confirmation') }}">Konfirmasi</a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('website.izin.show_control') }}">Kontrol</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('website.auth.logout') }}">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
