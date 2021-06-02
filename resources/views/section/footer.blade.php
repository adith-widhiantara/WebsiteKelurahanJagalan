<footer>
    <div class="footer-wrappper">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-6 col-sm-8">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="{{ route('landing') }}">
                                        <img src="{{ asset('assets/img/logo/logo2_footer.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>{{ App\Models\PengaturanWebsite::where('name', 'deskripsi_website')->first()->description }}</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="{{ __('https://wa.me/').App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description.__('?text=').App\Models\PengaturanWebsite::where('name', 'whatsapp_text_render')->first()->description }}" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="{{ __('tel:').App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description }}" target="_blank">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="{{ __('tel:').App\Models\PengaturanWebsite::where('name', 'home')->first()->description }}" target="_blank">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Daftar Layanan</h4>
                                <ul>
                                    <li>
                                        <a href="#">Berita Terbaru</a>
                                    </li>
                                    <li>
                                        <a href="#">Aduan Masyarakat</a>
                                    </li>
                                    <li>
                                        <a href="#">Pengajuan Surat</a>
                                    </li>
                                    <li>
                                        <a href="#">Profil Saya</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Berita Kelurahan</h4>
                                <ul>
                                    @foreach (App\Models\News\Category::take(4)->orderBy('created_at', 'desc')->get() as $cat)
                                    <li>
                                        <a href="{{ route('category.show', $cat->slug) }}">{{ $cat->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p>
                                    Copyright &copy;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script> Kelurahan Jagalan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </div>
</footer>
