<?php

namespace Database\Seeders;

use App\Models\News\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        $user = User::factory()->create(['nama' => 'admin', 'nomor_ktp' => 'admin']);
        $user->assignRole('admin');

        News::factory()->count(3)->for($user)->forCategory()->create();

        for ($i = 0; $i < 2; $i++) {
            News::factory()->count(3)->forUser()->forCategory()->create();
        }

        $this->call([
            PengaturanWebsiteSeeder::class,
            DataKartuKeluargaSeeder::class,
            GolonganDarahSeeder::class,
            JenisAntrianSeeder::class
        ]);
    }
}
