<?php

namespace Database\Seeders;

use App\Models\KartuKeluarga\GolonganDarah;
use Illuminate\Database\Seeder;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $golonganDarah = [
            'A',
            'B',
            'AB',
            'O',
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-',
            'Tidak Tahu'
        ];

        foreach ($golonganDarah as $darah) {
            GolonganDarah::create([
                'keterangan' => $darah
            ]);
        }
    }
}
