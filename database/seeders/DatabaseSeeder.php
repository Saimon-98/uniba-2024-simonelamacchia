<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Inizializzare database dell'app, creando 10 nuovi record con dati casuali.
     */
    public function run(): void
    {
        \App\Models\Products::factory(10)->create();
    }
}
