<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\PengaturanWebsite;
use PhpParser\Node\Stmt\Foreach_;

class PengaturanWebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $dataPengaturan = [
            [
                'name' => 'deskripsi_website',
                'description' => $faker->sentence($nbWords = 15, $variableNbWords = true),
            ],
            [
                'name' => 'telepon',
                'description' => '6281235916971'
            ],
            [
                'name' => 'whatsapp_text',
                'description' => 'Hai saya dari pengguna website Kelurahan Jagalan'
            ],
            [
                'name' => 'whatsapp_text_render',
                'description' => Str::slug('Hai saya dari pengguna website Kelurahan Jagalan', '%20')
            ],
            [
                'name' => 'home',
                'description' => '0354689171'
            ],
            [
                'name' => 'email',
                'description' => 'kelurahanjagalan@gmail.com'
            ],
            [
                'name' => 'alamat',
                'description' => '768/A, Green lane 790, Max town Indonesia'
            ],
            [
                'name' => 'deskripsi_penghargaan',
                'description' => 'Technological information and others, in addition to information about companies in the sector, list of any and all companies related to agribusiness.'
            ],
            [
                'name' => 'deskripsi_penghargaan_1',
                'description' => $faker->sentence($nbWords = 10, $variableNbWords = true)
            ],
            [
                'name' => 'deskripsi_penghargaan_2',
                'description' => $faker->sentence($nbWords = 10, $variableNbWords = true)
            ],
            [
                'name' => 'deskripsi_penghargaan_3',
                'description' => $faker->sentence($nbWords = 10, $variableNbWords = true)
            ],
        ];

        foreach ($dataPengaturan as $data) {
            PengaturanWebsite::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
        }
    }
}
