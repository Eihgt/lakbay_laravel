<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Events>
 */
class EventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ev_name' => fake()->sentence(3),
            'ev_venue' => fake()->address(),
            'ev_date_start' => fake()->date(),
            'ev_time_start' => fake()->time(),
            'ev_date_end' => fake()->date(),
            'ev_time_end' => fake()->time(),
            'ev_date_added' => fake()->date(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
