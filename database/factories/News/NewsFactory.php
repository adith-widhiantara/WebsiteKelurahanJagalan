<?php

namespace Database\Factories\News;

use App\Models\News\Category;
use App\Models\User;
use App\Models\News\News;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true);
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::of($title)->slug('-'),
            'photo' => 'https://placeimg.com/640/480/any',
            'description' => $this->faker->text($maxNbChars = 100)
        ];
    }
}
