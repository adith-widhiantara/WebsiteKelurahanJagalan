<?php

namespace Database\Seeders;

use App\Models\Surat\Jenis;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SuratJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $dataNamaSurat = [
            'Surat Keterangan Usaha',
            'Surat Keterangan Tidak Mampu',
            'Surat Keterangan Belum Pernah Menikah',
            'Surat Keterangan Beda Nama',
            'Surat Keterangan Penghasilan',
            'Surat Keterangan Harga Tanah'
        ];

        $dataSuratJenis = array();
        foreach ($dataNamaSurat as $key => $data) {
            $dataSuratJenis[$key]['nama_surat'] = $data;
            $dataSuratJenis[$key]['slug'] = Str::slug($data, '_');
            $dataSuratJenis[$key]['format_nomor_surat'] = Str::slug($data, '_');
            $dataSuratJenis[$key]['keterangan'] = $faker->sentence($nbWords = 20, $variableNbWords = true);
        }

        foreach ($dataSuratJenis as $data) {
            Jenis::create([
                'nama_surat' => $data['nama_surat'],
                'slug' => $data['slug'],
                'format_nomor_surat' => $data['format_nomor_surat'],
                'keterangan' => $data['keterangan'],
            ]);
        }
    }
}
