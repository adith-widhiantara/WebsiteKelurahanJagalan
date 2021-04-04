<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga\Agama;
use App\Models\KartuKeluarga\Pekerjaan;
use App\Models\KartuKeluarga\Pendidikan;
use App\Models\KartuKeluarga\PenyandangCacat;
use App\Models\KartuKeluarga\StatusHubunganKepala;
use App\Models\KartuKeluarga\StatusPerkawinan;
use Illuminate\Database\Seeder;

class DataKartuKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataAgama = [
            'Islam',
            'Kristen',
            'Katholik',
            'Hindu',
            'Budha',
            'Khonghucu',
            'Kepercayaan Terhadap Tuhan Yang Maha Esa',
        ];

        foreach ($dataAgama as $agama) {
            Agama::create([
                'keterangan' => $agama
            ]);
        }

        $dataStatusPerkawinan = [
            'Belum Kawin',
            'Kawin',
            'Cerai Hidup',
            'Cerai Mati',
        ];

        foreach ($dataStatusPerkawinan as $statusPerkawinan) {
            StatusPerkawinan::create([
                'keterangan' => $statusPerkawinan
            ]);
        }

        $dataStatusHubungan = [
            'Kepala Keluarga',
            'Suami',
            'Isteri',
            'Anak',
            'Menantu',
            'Cucu',
            'Orang Tua',
            'Mertua',
            'Famili Lain',
            'Pembantu',
            'Lainnya'
        ];

        foreach ($dataStatusHubungan as $statusHubungan) {
            StatusHubunganKepala::create([
                'keterangan' => $statusHubungan
            ]);
        }

        $dataPenyandangCacat = [
            'Tidak Ada Cacat',
            'Cacat Fisik',
            'Cacat Netra/Buta',
            'Cacat Rungu/Wicara',
            'Cacat Mental/Jiwa',
            'Cacat Fisik dan Mental',
            'Cacat Lainnya',
        ];

        foreach ($dataPenyandangCacat as $penyandangCacat) {
            PenyandangCacat::create([
                'keterangan' => $penyandangCacat
            ]);
        }

        $dataPendidikanTerakhir = [
            'Tidak/Belum Sekolah',
            'Belum Tamat SD/Sederajat',
            'Tamat SD/Sederajat',
            'SLTP/Sederajat',
            'SLTA/Sederajat',
            'Diploma I/II',
            'Akademi/Diploma III Sarjana Muda',
            'Diploma IV/Strata I',
            'Strata II',
            'Strata III',
        ];

        foreach ($dataPendidikanTerakhir as $pendidikanTerakhir) {
            Pendidikan::create([
                'keterangan' => $pendidikanTerakhir
            ]);
        }

        $dataPekerjaan = [
            'Belum/Tidak Bekerja',
            'Mengurus Rumah Tangga',
            'Pelajar / Mahasiswa',
            'Pensiunan',
            'Pegawai Negeri Sipil (PNS)',
            'Tentara Nasional Indonesia (TNI)',
            'Kepolisian RI (POLRI)',
            'Perdagangan',
            'Petani/Pekebun',
            'Peternak',
            'Nelayan/Perikanan',
            'Industri',
            'Konstruksi',
            'Transportasi',
            'Karyawan Swasta',
            'Karyawan BUMN',
            'Karyawan BUMD',
            'Karyawan Honorer',
            'Buruh Harian Lepas',
            'Buruh Tani/Perkebunan',
            'Buruh Nelayan/Perikanan',
            'Buruh Peternakan',
            'Pembantu Rumah Tangga',
            'Tukang Cukur',
            'Tukang Listrik',
            'Tukang Batu',
            'Tukang Kayu',
            'Tukang Sol Sepatu',
            'Tukang Las/Pandai Besi',
            'Tukang Jahit',
            'Tukang Gigi',
            'Penata Rias',
            'Penata Busana',
            'Penata Rambut',
            'Mekanik',
            'Seniman',
            'Tabib',
            'Perajin',
            'Perancang Busana',
            'Penterjemah',
            'Imam Masjid',
            'Pendeta',
            'Pastor',
            'Wartawan',
            'Ustad/Mubaligh',
            'Juru Masak',
            'Promotor Acara',
            'Anggota DPR-RI',
            'Anggota DPD',
            'Anggota BPK',
            'Presiden',
            'Wakil Presiden',
            'Anggota Makamah Konstitusi',
            'Anggota Kabinet/Kementrian',
            'Duta Besar',
            'Gubernur',
            'Wakil Gubernur',
            'Bupati',
            'Wakil Bupati',
            'Walikota',
            'Wakil Walikota',
            'Anggota DPRD Prop.',
            'Anggota DPRD Kab./Kota',
            'Dosen',
            'Guru',
            'Pilot',
            'Pengacara',
            'Notaris',
            'Arsitek',
            'Akuntan',
            'Konsultan',
            'Dokter',
            'Bidan',
            'Perawat',
            'Apoteker',
            'Psikiater/Psikolog',
            'Penyiar Televisi',
            'Penyiar Radio',
            'Pelaut',
            'Peneliti',
            'Sopir',
            'Pialang',
            'Paranormal',
            'Pedagang',
            'Perangkat Desa',
            'Kepala Desa',
            'Biarawati',
            'Wiraswasta',
            'Lainnya'
        ];

        foreach ($dataPekerjaan as $pekerjaan) {
            Pekerjaan::create([
                'keterangan' => $pekerjaan
            ]);
        }
    }
}
