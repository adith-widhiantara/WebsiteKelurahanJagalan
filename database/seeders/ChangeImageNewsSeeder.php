<?php

namespace Database\Seeders;

use App\Models\News\News;
use Illuminate\Database\Seeder;

class ChangeImageNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 23; $i++) {
            News::where('photo', 'https://placeimg.com/640/480/any')
                ->update([
                    'photo' => 'default.png'
                ]);
        }
    }
}
