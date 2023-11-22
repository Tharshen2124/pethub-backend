<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
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
            // $table->id('report_id');
            // $table->foreignId('user_id');
            // $table->string('report_title');
            // $table->text('report_description');
            'report_title' => fake()->word(),
            'report_description' => fake()->text(),
        ];
    }
}
