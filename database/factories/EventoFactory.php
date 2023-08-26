<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            //
            "nome"=>fake()->unique()->sentence(3),
            "descricao"=>fake()->text,
            "start_time"=>fake()->dateTimeBetween("now","+1 month"),
            "end_time"=>fake()->dateTimeBetween("+1 month","+2 month"),
        ];
    }
}
