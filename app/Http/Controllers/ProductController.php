<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Per le REST Api si utilizzano funzioni con nomi specifici:
    // Funzione Index per ritornare in formato json la risposta di tutti i post con 200 come status OK
    public function index(){
        return response()->json(Product::all(),200);
    }

    //Funzione Store per inserire un prodotto nuovo
    public function store(Request $request){
        // Validiamo la richiesta
        $request->validate([
            'name' => 'required|string|max:50',
            'co2_saved' => 'required|integer|min:0'
        ]);

        // Creiamo il prodotto con i dati arrivati dalla richiesta
        $product = Product::create([
            'name' => $request->name,
            'co2_saved' => $request->co2_saved,
        ]);

        // Ritorniamo la risposta con l'inserimento del prodotto e 201 di conferma
        return response()->json($product, 201);
    }

    //Funzione Update per aggiornare e modificare un prodotto già esistente
    public function update(Request $request, $id){
        // Ricerchiamo il prodotto
        
        $product = Product::find($id);
        // Se il prodotto esiste lo validiamo e andiamo ad aggiornarlo
        if ($product) {
            // Validazione dati in ingresso
           $request->validate([
            'name' => 'required|string|max:50',
            'co2_saved' => 'required|integer|min:0'
            ]);

            // Aggiornamento del prodotto
            $product->update($request->only(['name', 'co2_saved']));

            // Ritorniamo il prodotto in json e 200 OK
            return response()->json($product, 200);
        } else {
            // Ritorniamo il messaggio di prodotto non trovato con cod errore 404
            return response()->json(['message' => 'Prodotto non trovato!', 404]);
        }
    }

    // Funzione Destroy per cancellare un prodotto specifico
    public function destroy($id){
        // Ricerchiamo il prodotto
        $product = Product::find($id);

        // Se il prodotto esiste, elimino e mando messaggio di conferma
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Prodotto eliminato con successo', 200]);
        } else {
            // Ritorniamo il messaggio di prodotto non trovato con cod errore 404
            return response()->json(['message' => 'Prodotto non trovato!', 404]);
        }
    }
}
