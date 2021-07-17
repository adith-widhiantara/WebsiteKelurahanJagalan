<div class="services-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle mb-60 text-center">
                    <h2>
                        Layanan Online Kelurahan Jagalan
                    </h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-xl-6">
                <div class="single-services mb-30">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="features-img">
                                <img src="{{ asset('storage/aduan/bgimage/'.$imageAduan) }}" style="object-fit: cover">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="features-caption">
                                <span>
                                    01
                                </span>
                                <h1>
                                    Aduan Masyarakat
                                </h1>
                                <p>
                                    Penyampaian keluhan oleh masyarakat Kelurahan Jagalan kepada Pengurus Kelurahan Jagalan atas pelayanan atau sarana prasarana yang tidak sesuai dengan standar pelayanan.
                                </p>
                                <a href="{{ route('aduan.index') }}" class="btn">
                                    Aduan Masyarakat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="single-services mb-30">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="features-img">
                                <img src="{{ asset('storage/surat/bgimage/'.$imageSurat) }}" style="object-fit: cover">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="features-caption">
                                <span>
                                    02
                                </span>
                                <h1>
                                    Pengajuan Surat
                                </h1>
                                <p>
                                    Pengajuan berbagai surat dari masyarakat Kelurahan Jagalan kepada Pengurus Kelurahan Jagalan.
                                </p>
                                <a href="{{ route('warga.surat.index') }}" class="btn">
                                    Pengajuan Surat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
