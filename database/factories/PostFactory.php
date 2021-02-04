<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text;
        return [
            'title' => $this->faker->sentence(3),
            'description' => $title,
            'slug'             => Str::slug($title, "-") .'-'. random_int(2, 1000),
            'user_id'     => User::factory()->create()->id,
            'publication_date' => now()
        ];
    }
}
