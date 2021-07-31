<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.index') }}" class="nav-link">Halaman Utama</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- profile --}}
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->foto ? asset('storage/user/foto/'.Auth::user()->foto) : asset('lte/dist/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2" alt="User Image" style="object-fit: cover">
                <span class="d-none d-md-inline">{{ Auth::user()->nama }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img src="{{ Auth::user()->foto ? asset('storage/user/foto/'.Auth::user()->foto) : asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" style="object-fit: cover">
                    <p>
                        {{ Auth::user()->nama.__(' - ').Auth::user()->getRoleNames()[0] }}
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{ route('admin.pengurus.profilSaya') }}" class="btn btn-default btn-flat">Profil Saya</a>
                    <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>

                    <form style="display: none" action="{{ route('logout') }}" method="post" id="logout-form">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        {{-- end profile --}}

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
