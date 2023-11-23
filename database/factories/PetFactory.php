<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
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
            // $table->id('pet_id');
            // $table->foreignId('user_id');
            // $table->string('pet_name');
            // $table->string('species');
            // $table->string('breed');
            // $table->text('description');
            // $table->integer('age');
            // $table->string('image');
            'pet_name' => fake()->name(),
            
            'description'=> fake()->text(),
            'age' => fake()->randomDigitNot(0),
            'image' => fake()->imageUrl(640, 480, 'animals', true),

        ];
    }
}
