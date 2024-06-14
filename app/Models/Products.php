<?php

//Creazione modello per la tabella del database

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    //Aggiornare il modello registrando le variabili assegnabili in massa.
    //Creare o aggiornare un modello con un array di attributi.
    protected $fillable = [
        'name', 'price', 'description'
    ];
}
