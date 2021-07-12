<section class="about-area2 pb-bottom mt-30">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-caption about-caption2 mb-50">
                    <!-- Section Tittle -->
                    <div class="section-tittle mb-25">
                        <h2>Pencapaian<br>Kami</h2>
                        <p class="mb-20">
                            {{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan')->first() ? App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan')->first()->description : '' }}
                        </p>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <i class="fas fa-caret-right" style="color: #285D25"></i>
                        </div>
                        <div class="features-caption">
                            <p>
                                {{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_1')->first() ? App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_1')->first()->description : '' }}
                            </p>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="features-icon">
                            <i class="fas fa-caret-right" style="color: #285D25"></i>
                        </div>
                        <div class="features-caption">
                            <p>
                                {{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_2')->first() ? App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_2')->first()->description : '' }}
                            </p>
                        </div>
                    </div>
                    <div class="single-features mb-40">
                        <div class="features-icon">
                            <i class="fas fa-caret-right" style="color: #285D25"></i>
                        </div>
                        <div class="features-caption">
                            <p>
                                {{ App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_3')->first() ? App\Models\PengaturanWebsite::where('name', 'deskripsi_penghargaan_3')->first()->description : '' }}
                            </p>
                        </div>
                    </div>
                    <a href="tel:{{ App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description }}" class="btn"><i class="fas fa-phone-alt"></i>{{ App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description }}</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <!-- about-img -->
                <div class="about-img about-img2  ">
                    <img src="{{ asset('assets/img/gallery/about2.png') }}" alt="">
                    {{-- <div class="info-man text-center">
                        <div class="head-cap">
                            <img src="{{ asset('assets/img/icon/agronomy.svg') }}" alt="">
                    <p>Best Plants</p>
                </div>
            </div>
            <div class="info-man info-man2 text-center">
                <div class="head-cap">
                    <img src="{{ asset('assets/img/icon/fields.svg') }}" alt="">
                    <p>Award Wining</p>
                </div>
            </div> --}}
        </div>
    </div>
    </div>
    </div>
</section>
