<header>
    <div class="header-area">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('landing') }}"><img src="{{ asset('assets/img/logo/logo.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li>
                                                <a href="{{ route('landing') }}">Halaman Utama</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('news.index') }}">Berita</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('aduan.index') }}">Aduan Masyarakat</a>
                                            </li>
                                            <li>
                                                <a href="#">Pengajuan Surat</a>
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="{{ route('warga.surat.index') }}">Lihat Surat Saya</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Buat Surat Pengajuan</a>
                                                        <ul class="submenu">
                                                            @foreach (\App\Models\Surat\Jenis::all() as $jenis)
                                                            <li>
                                                                <a href="{{ route('warga.surat.create', $jenis->slug) }}">
                                                                    {{ $jenis -> nama_surat }}
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>

                                            @guest {{-- Login --}}
                                            <li>
                                                <a href="{{ route('login') }}">
                                                    Masuk
                                                </a>
                                            </li>
                                            @endguest {{-- End Login --}}

                                            @auth {{-- Auth --}}
                                            @role('admin|petugas|RW|kepala_kelurahan') {{-- role('admin|petugas|RW|kepala_kelurahan') --}}
                                            <li>
                                                @role('admin') <a href="#">Admin</a> @endrole

                                                @role('petugas') <a href="#">Petugas</a> @endrole

                                                @role('RW') <a href="#">RW</a> @endrole

                                                @role('kepala_kelurahan') <a href="#">Kepala Kelurahan</a> @endrole

                                                <ul class="submenu">
                                                    <li>
                                                        <a href="{{ route('admin.index') }}">Lihat Panel</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            Keluar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @else {{-- role('admin|petugas|RW|kepala_kelurahan') --}}
                                            <li>
                                                <a href="#">Warga</a>
                                                <ul class="submenu">
                                                    <li>
                                                        <a href="{{ route('user.show') }}">
                                                            Lihat Profil
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            Keluar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @endrole {{-- role('admin|petugas|RW|kepala_kelurahan') --}}
                                            <form style="display: none" action="{{ route('logout') }}" method="post" id="logout-form">
                                                @csrf
                                            </form>
                                            @endauth {{-- endauth --}}
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right-btn d-none d-lg-block ml-40">
                                    <a href="#" class="btn">
                                        <i class="fas fa-paper-plane"></i>
                                        Daftar Berita Terbaru
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
