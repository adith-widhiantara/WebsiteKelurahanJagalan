<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kelurahan Jagalan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->foto ? asset('storage/user/foto/'.Auth::user()->foto) : asset('lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" style="height: 30px; object-fit: cover">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="text" placeholder="Cari Berita" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Kembali Ke Website --}}
                <li class="nav-item">
                    <a href="{{ route('landing') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Kembali Ke Website
                        </p>
                    </a>
                </li>
                {{-- end Kembali Ke Website --}}

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
                {{-- end Halaman Utama --}}

                {{-- Kartu Keluarga --}}
                @php
                $kartukeluargaActive =
                url()->current() == route('admin.kartukeluarga.index') ||
                url()->current() == route('admin.kartukeluarga.create') ||
                url()->current() == route('admin.tabelkartukeluarga.index') ||
                url()->current() == route('admin.kartukeluarga.warga');
                @endphp

                <li class="nav-item @if ( $kartukeluargaActive ) menu-open @endif">
                    <a href="#" class="nav-link @if ( $kartukeluargaActive ) active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Kartu Keluarga
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @if (url()->current() == route('admin.kartukeluarga.index'))
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kartu Keluarga</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('admin.kartukeluarga.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kartu Keluarga</p>
                            </a>
                        </li>
                        @endif

                        @if (url()->current() == route('admin.kartukeluarga.warga'))
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Warga</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('admin.kartukeluarga.warga') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Warga</p>
                            </a>
                        </li>
                        @endif

                        @if (url()->current() == route('admin.kartukeluarga.create'))
                        <li class="nav-item active">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buat Kartu Keluarga</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('admin.kartukeluarga.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buat Kartu Keluarga</p>
                            </a>
                        </li>
                        @endif

                        @if (url()->current() == route('admin.tabelkartukeluarga.index'))
                        <li class="nav-item active">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Kartu Keluarga</p>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('admin.tabelkartukeluarga.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tabel Kartu Keluarga</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
                {{-- end Kartu Keluarga --}}

                {{-- Daftar Aduan --}}
                @php
                $aduanActive =
                url()->current() == route('admin.aduan.index') ||
                url()->current() == route('admin.aduan.thisMonthIndex') ||
                url()->current() == route('admin.aduan.tindaklanjut.index');
                @endphp

                <li class="nav-item @if ( $aduanActive ) menu-open @endif ">
                    <a href="#" class="nav-link @if ( $aduanActive ) active @endif ">
                        <i class="nav-icon fas ion-ios-paper"></i>
                        <p>
                            Daftar Aduan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (url()->current() == route('admin.aduan.thisMonthIndex'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aduan Bulan Ini</p>
                            </a>
                            @else
                            <a href="{{ route('admin.aduan.thisMonthIndex') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aduan Bulan Ini</p>
                            </a>
                            @endif
                        </li>
                        @role('RW|kepala_kelurahan')
                        <li class="nav-item">
                            @if (url()->current() == route('admin.aduan.tindaklanjut.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tindak Lanjut Aduan</p>
                            </a>
                            @else
                            <a href="{{ route('admin.aduan.tindaklanjut.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tindak Lanjut Aduan</p>
                            </a>
                            @endif
                        </li>
                        @endrole
                        <li class="nav-item">
                            @if (url()->current() == route('admin.aduan.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seluruh Aduan</p>
                            </a>
                            @else
                            <a href="{{ route('admin.aduan.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seluruh Aduan</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                {{-- end Daftar Aduan --}}

                {{-- News --}}
                @php
                $newsActive =
                url()->current() == route('admin.category.index') ||
                url()->current() == route('admin.news.create') ||
                url()->current() == route('admin.news.index');
                @endphp

                <li class="nav-item @if ( $newsActive ) menu-open @endif">
                    <a href="#" class="nav-link @if ( $newsActive ) active @endif">
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
                {{-- end News --}}

                {{-- Permintaan Surat --}}
                @php
                $suratActive =
                url()->current() == route('admin.jenis.index') ||
                url()->current() == route('admin.surat.index');
                @endphp

                <li class="nav-item @if ( $suratActive ) menu-open @endif">
                    <a href=" #" class="nav-link @if ( $suratActive ) active @endif">
                        <i class=" nav-icon fas ion-android-clipboard"></i>
                        <p>
                            Permintaan Surat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (url()->current() == route('admin.surat.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Seluruh Surat</p>
                            </a>
                            @else
                            <a href="{{ route('admin.surat.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Seluruh Surat</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (url()->current() == route('admin.jenis.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Jenis Surat</p>
                            </a>
                            @else
                            <a href="{{ route('admin.jenis.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Jenis Surat</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                {{-- end Permintaan Surat --}}

                {{-- Pendataan Warga --}}
                @php
                $pengaturanWargaActive =
                url()->current() == route('admin.kelahiran.index') ||
                url()->current() == route('admin.kematian.index') ||
                url()->current() == route('admin.pindahmasuk.index') ||
                url()->current() == route('admin.pindahkeluar.index');
                @endphp

                <li class="nav-item @if ( $pengaturanWargaActive ) menu-open @endif">
                    <a href=" #" class="nav-link @if ( $pengaturanWargaActive ) active @endif">
                        <i class=" nav-icon fas fa-people-carry"></i>
                        <p>
                            Pendataan Warga
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (url()->current() == route('admin.kelahiran.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kelahiran</p>
                            </a>
                            @else
                            <a href="{{ route('admin.kelahiran.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kelahiran</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (url()->current() == route('admin.kematian.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kematian</p>
                            </a>
                            @else
                            <a href="{{ route('admin.kematian.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kematian</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (url()->current() == route('admin.pindahmasuk.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pindah Masuk</p>
                            </a>
                            @else
                            <a href="{{ route('admin.pindahmasuk.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pindah Masuk</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (url()->current() == route('admin.pindahkeluar.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pindah Keluar</p>
                            </a>
                            @else
                            <a href="{{ route('admin.pindahkeluar.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pindah Keluar</p>
                            </a>
                            @endif
                        </li>
                    </ul>
                </li>
                {{-- end Pendataan Warga --}}

                {{-- Daftar Antrian --}}
                @php
                $daftarAntrianActive =
                url()->current() == route('admin.antrian.index.today') ||
                url()->current() == route('admin.antrian.index');
                @endphp

                <li class="nav-item @if ( $daftarAntrianActive ) menu-open @endif">
                    <a href=" #" class="nav-link @if ( $daftarAntrianActive ) active @endif">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>
                            Daftar Antrian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            @if (url()->current() == route('admin.antrian.index.today'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Antrian Hari Ini</p>
                            </a>
                            @else
                            <a href="{{ route('admin.antrian.index.today') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Antrian Hari Ini</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            @if (url()->current() == route('admin.antrian.index'))
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Seluruh Antrian</p>
                            </a>
                            @else
                            <a href="{{ route('admin.antrian.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Seluruh Antrian</p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.antrian.pendaftaran') }}" class="nav-link" target="_blank">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Layar Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.antrian.pemanggilan') }}" class="nav-link" target="_blank">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Layar Pemanggilan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- end Daftar Antrian --}}

                {{-- Daftar Pengguna --}}
                @role('admin')
                @php
                $pengurusActive =
                url()->current() == route('admin.pengurus.index');
                @endphp

                <li class="nav-item">
                    @if (url()->current() == route('admin.pengurus.index'))
                    <a href="#" class="nav-link active">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                    @else
                    <a href="{{ route('admin.pengurus.index') }}" class="nav-link">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <p>Daftar Pengguna</p>
                    </a>
                    @endif
                </li>
                @endrole
                {{-- end Daftar Pengguna --}}

                {{-- Informasi Website --}}
                @role('admin')
                <li class="nav-item">
                    @if (url()->current() == route('admin.pengaturan.index'))
                    <a href="#" class="nav-link active">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>Pengaturan Website</p>
                    </a>
                    @else
                    <a href="{{ route('admin.pengaturan.index') }}" class="nav-link">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>Pengaturan Website</p>
                    </a>
                    @endif
                </li>
                @endrole
                {{-- End Informasi Website --}}
            </ul>
        </nav>
    </div>
</aside>
