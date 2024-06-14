<?php

//Creazione file di migrazione del modello

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Esegue le migrazioni.
     */
    public function up(): void
    {
        //Crea una nuova tabella chiamata 'products'.
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            /**
             * Aggiungiamo nome, prezzo e descrizione del prodotto in una colonna 'id'
             */
            $table->string('name');
            $table->double('price');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Inverte le migrazioni.
     */
    public function down(): void
    {
        //Elimina la tabella 'products' se esiste.
        Schema::dropIfExists('products');
    }
};
