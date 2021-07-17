<section class="slider-area ">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-bg1 hero-overly slider-height d-flex align-items-center" style="background-image: url({{ asset('storage/aduan/bgimage/'.$imageAduan) }});">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-9 col-md-12">
                        <div class="hero__caption text-center">
                            <h1 data-animation="bounceIn" data-delay="0.2s">
                                Aduan Masyarakat
                            </h1>
                            <p data-animation="fadeInUp" data-delay="0.4s">
                                Penyampaian keluhan oleh masyarakat Kelurahan Jagalan kepada Pengurus Kelurahan Jagalan.
                            </p>
                            <a href="{{ route('aduan.index') }}" class="hero-btn" data-animation="fadeInUp" data-delay="0.7s">
                                Menuju Layanan Ini
                                <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Slider -->
        <div class="single-slider slider-bg2 hero-overly slider-height d-flex align-items-center" style="background-image: url({{ asset('storage/surat/bgimage/'.$imageSurat) }});">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-9 col-md-12">
                        <div class="hero__caption text-center">
                            <h1 data-animation="bounceIn" data-delay="0.2s">
                                Pengajuan Surat
                            </h1>
                            <p data-animation="fadeInUp" data-delay="0.4s">
                                Pengajuan berbagai surat dari masyarakat Kelurahan Jagalan kepada Pengurus Kelurahan Jagalan.
                            </p>
                            <a href="{{ route('warga.surat.index') }}" class="hero-btn" data-animation="fadeInUp" data-delay="0.7s">
                                Menuju Layanan Ini
                                <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
