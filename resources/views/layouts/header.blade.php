<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button>
    <a class="c-header-brand d-md-none" href="{{ route('admin.home') }}">
        <img class="c-header-brand " src="{{ asset('assets/img/stmik-logo.png') }}" height="46">
    </a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar"><img class="c-avatar-img" src="{{
                    Auth::guard('admin')->check() ?
                    (file_exists('storage/'.auth('admin')->user()->profil_admin->pas_foto) ? asset('storage/'.auth('admin')->user()->profil_admin->pas_foto) : asset('assets/img/icon-user.jpg')) :
                    (file_exists('storage/'.auth('mahasiswa')->user()->profil_mhs->pas_foto) ? asset('storage/'.auth('mahasiswa')->user()->profil_mhs->pas_foto) : asset('assets/img/icon-user.jpg'))
                }}"></div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="cil-account-logout mr-2"></i>Logout
                    <form action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}" method="POST" id="logout-form"> @csrf
                    <button type="submit" class="btn btn-ghost-dark btn-block d-none">Logout</button></form>
                </a>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            @yield('breadcrumbs')
        </ol>
    </div>
</header>

