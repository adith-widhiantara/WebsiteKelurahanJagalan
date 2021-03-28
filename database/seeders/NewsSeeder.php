<?php

namespace Database\Seeders;

use App\Models\News\News;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
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

        $faker = Faker::create();
        for ($j = 1; $j < 5; $j++) {
            for ($i = 3; $i < 9; $i++) {

                $title = $faker->sentence($nbWords = 6, $variableNbWords = true);

                News::create([
                    'user_id' => $i,
                    'category_id' => $j,
                    'title' => $title,
                    'slug' => Str::of($title)->slug('-'),
                    'photo' => 'default.png',
                    'description' => $faker->text($maxNbChars = 1000),
                    'role' => 1,
                    'show' => 1,
                ]);
            }
        }
    }
}
