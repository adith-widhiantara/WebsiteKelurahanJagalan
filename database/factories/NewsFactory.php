<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\User;
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
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => Str::of($this->faker->sentence($nbWords = 6, $variableNbWords = true))->slug('-'),
            'photo' => 'https://placeimg.com/640/480/any',
            'description' => $this->faker->text($maxNbChars = 100)
        ];
    }
}
