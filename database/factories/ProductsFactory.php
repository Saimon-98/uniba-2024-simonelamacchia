<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Definire i valori di default per gli attributi del modello.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            /**
             * Genera una parola casuale per il nome, prezzo numero casuale compreso tra 1 e 99,
             * descrizione composta da una frase casuale.
             */
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(1, 99),
            'description' => $this->faker->sentence()
        ];
    }
}
