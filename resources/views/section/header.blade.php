<header>
    <div class="header-area">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="{{ route('landing') }}"><img src="{{ asset('assets/img/logo/logo.png') }}"
                                        alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('landing') }}">Halaman Utama</a></li>
                                            <li><a href="{{ route('news.index') }}">Berita</a></li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="#">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog_details.html">Blog Details</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                </ul>
                                            </li>
                                            @guest
                                            <li>
                                                <a href="{{ route('login') }}">
                                                    Masuk
                                                </a>
                                            </li>
                                            @endguest

                                            @auth
                                            @role('admin')
                                            <li>
                                                <a href="#">Admin</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('admin.index') }}">Lihat Panel</a></li>
                                                    <li>
                                                        <a href="#"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            Keluar
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            @else
                                            <li>
                                                <a href="#">Profil Saya</a>
                                            </li>
                                            @endrole
                                            <form style="display: none" action="{{ route('logout') }}" method="post"
                                                id="logout-form">
                                                @csrf
                                            </form>
                                            @endauth
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