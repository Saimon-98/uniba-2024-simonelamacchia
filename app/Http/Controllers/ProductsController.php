<?php

//Creiamo un controller API RESTFUL pieno di risorse.

namespace App\Http\Controllers;
//Importiamo risorse necessarie
use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Visualizzare un elenco di risorse.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Restituire elenco delle risorse di prodotti nel database
        return Products::all();
    }

    /**
     * Creare nuova risorsa nel database
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Riceve i dati del prodotto tramite la richiesta HTTP.
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');

        $product = Products::create([
            'name' => $product_name,
            'price' => $product_price,
            'description' => $product_description,
        ]);
        return response()->json([
            'data' => new ProductResource($product)
        ], 201);
        // Visualizzato che è stata creata una risorsa incapsulato in una 'ProductResource'
    }

    /**
     * Visualizzare una precisa risora.
     * 
     * @param Products $product
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //restituire singola risorsa di prodotto nel database.
        //id del prodotto come parametro.
        /**
         * Trovare il prodotto o lanciare un'eccezione se non trovato.
         */
        $product = Products::findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Aggiornare una precisa risorsa in archivio.
     * 
     * @param \Illuminate\Http\Request $request
     * @param Products $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        //Aggiornare una risorsa di prodotto esistente.
        //Riceve nuovi dati del prodotto e ID da aggiornare.
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');

        $product->update([
            'name' => $product_name,
            'price' => $product_price,
            'description' => $product_description,
        ]);
        return response()->json([
            'data' => new ProductResource($product)
        ], 200);
        //Trattiamo di un codice di successo con risposta predefinita incapsulato in una 'ProductResource'
    }

    /**
     * Rimuovere una precisa risorsa in archivio.
     * 
     * @param Products $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        //Eliminare una risorsa di prodotto esistente nel database
        //ID del prodotto da eliminare.
        $product = Products::findOrFail($id);
        $product->delete();
        
        return response()->json(null,204);
        //Esito positivo, ma non viene restituito alcun contenuto, eliminazione avvenuta con successo.
    }
}
