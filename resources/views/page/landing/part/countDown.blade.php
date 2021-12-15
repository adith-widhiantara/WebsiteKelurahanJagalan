<div class="count-down-area pt-90 pb-80">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-12 col-md-12">
                <div class="count-down-wrapper border-bottom">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter">
                                <span class="counter">
                                    {{ App\Models\News\News::count() }}
                                </span>
                            </div>
                            <div class="pera-count mb-50">
                                <p>
                                    Banyak berita yang dapat dilihat oleh masyarakat umum.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter">
                                <span class="counter">
                                    {{ App\Models\Warga\KartuKeluarga::count() }}
                                </span>
                            </div>
                            <div class="pera-count mb-50">
                                <p>
                                    Jumlah kartu keluarga yang berada di Desa Penambangan.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter">
                                <span class="counter">
                                    {{ App\Models\Warga\AnggotaKeluarga::count() }}
                                </span>
                            </div>
                            <div class="pera-count">
                                <p>
                                    Jumlah warga yang berada di Desa Penambangan.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <!-- Counter Up -->
                            <div class="single-counter">
                                <span class="counter">
                                    {{ App\Models\Surat\Administrasi::count() }}
                                </span>
                            </div>
                            <div class="pera-count mb-50">
                                <p>
                                    Banyak surat warga yang telah diproses.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
