<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kelurahan Jagalan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="text" placeholder="Cari Berita"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Kembali Ke Website --}}
                <li class="nav-item">
                    <a href="{{ route('landing') }}" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Kembali Ke Website
                        </p>
                    </a>
                </li>

                {{-- Halaman Utama --}}
                <li class="nav-item">
                    @if ( url()->current() == route('admin.index') )
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                    @else
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Halaman Utama
                        </p>
                    </a>
                    @endif
                </li>

                {{-- Daftar Aduan --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas ion-ios-paper"></i>
                        <p>
                            Daftar Aduan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aduan Bulan Ini</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aduan Belum Selesai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seluruh Aduan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @php
                $newsActive =
                url()->current() == route('admin.category.index') ||
                url()->current() == route('admin.news.create') ||
                url()->current() == route('admin.news.index');
                @endphp

                {{-- News --}}
                <li class="nav-item @if ( $newsActive ) menu-open @endif ">
                    <a href="#" class="nav-link @if ( $newsActive ) active @endif ">
                        <i class="nav-icon fas ion-social-buffer"></i>
                        <p>
                            Daftar Berita
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if ( url()->current() == route('admin.news.create') )
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buat Berita</p>
                            </a>
                            @else
                            <a href="{{ route('admin.news.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buat Berita</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if ( url()->current() == route('admin.category.index') )
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Kategory Berita</p>
                            </a>
                            @else
                            <a href="{{ route('admin.category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Kategory Berita</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if ( url()->current() == route('admin.news.index') )
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Berita</p>
                            </a>
                            @else
                            <a href="{{ route('admin.news.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Berita</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>

                {{-- Permintaan Surat --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas ion-android-clipboard"></i>
                        <p>
                            Permintaan Surat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Permintaan Surat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Surat Kelurahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Seluruh Surat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Jenis Surat</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Daftar Pengguna --}}
                @role('admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                </li>
                @endrole

            </ul>
        </nav>
    </div>
</aside>