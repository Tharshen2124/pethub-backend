<?php

namespace Database\Factories;

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
            //ref
            // $table->id('post_id');
            // $table->foreignId('user_id');
            // $table->string('post_title');
            // $table->text('post_description');
            // $table->timestamps();
            'post_title' => fake()->word(),
            'post_description' => fake()->text(),

        ];
    }
}
