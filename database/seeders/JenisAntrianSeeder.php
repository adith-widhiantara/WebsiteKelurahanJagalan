<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Antrian\JenisAntrian;

class JenisAntrianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisAntrian = [
            [
                'name' => 'Petugas Kelurahan',
                'code' => 'PKL'
            ],
            [
                'name' => 'Petugas Pajak',
                'code' => 'PJK'
            ],
            [
                'name' => 'Kepala Kelurahan',
                'code' => 'KKL'
            ],
        ];

        foreach ($jenisAntrian as $jenis) {
            JenisAntrian::create([
                'name' => $jenis['name'],
                'slug' => Str::slug($jenis['name'], '_'),
                'code' => $jenis['code'],
            ]);
        }
    }
}
