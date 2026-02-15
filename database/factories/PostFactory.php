<?php

namespace Database\Factories;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'image_path' => 'https://picsum.photos/800/600?random=' . rand(1, 1000),
            'caption' => fake()->sentence(rand(5, 15)),
            'location' => fake()->city() . ', ' . fake()->country(),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'updated_at' => now(),
        ];
    }
}
