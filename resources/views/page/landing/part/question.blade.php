<div class="all-starups-area fix">
    <!-- left Contents -->
    <div class="starups">
        <div class="starups-details">
            <!-- Section Tittle -->
            <div class="section-tittle mb-35">
                <h2>Butuh Bantuan?</h2>
                <p>
                    Informasi bantuan meliputi bagian layanan kelurahan, seperti penayangan berita, informasi kelurahan, dan lain-lain.
                </p>
            </div>
            <!-- Details -->
            <div class="starups-list mb-30">
                <ul>
                    <li>
                        <i class="fas fa-phone"></i>
                    </li>
                    <li>
                        <p>
                            {{ App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description }}
                        </p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <i class="far fa-envelope"></i>
                    </li>
                    <li>
                        <p>{{ App\Models\PengaturanWebsite::where('name', 'email')->first()->description }}</p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                    </li>
                    <li>
                        <p>{{ App\Models\PengaturanWebsite::where('name', 'alamat')->first()->description }}</p>
                    </li>
                </ul>
            </div>
            <a href="{{ __('https://wa.me/').App\Models\PengaturanWebsite::where('name', 'telepon')->first()->description.__('?text=').App\Models\PengaturanWebsite::where('name', 'whatsapp_text_render')->first()->description }}" class="border-btn" target="_blank">
                Kirim Pesan melalui Whatsapp
            </a>
        </div>
    </div>
    <!--Right Contents  -->
    <div class="starups-img"></div>
</div>
