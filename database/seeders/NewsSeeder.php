<?php

namespace Database\Seeders;

use App\Models\News\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++) {
            News::where('id', $i)
                ->update([
                    'role' => 1
                ]);
        }
    }
}
