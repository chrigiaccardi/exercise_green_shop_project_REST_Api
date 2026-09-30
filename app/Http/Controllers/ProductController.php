<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    // Query per esercitazione:
    // Restituisce tutti i prodotti con co2_saved superiore a 350: "SELECT * FROM products WHERE co2_saved > 350";
    // Calcolo della co2 risparmiata per tutti i prodotti registrati: "SELECT SUM(co2_saved) FROM products";

    // Per le REST Api si utilizzano funzioni con nomi specifici:
    // Funzione Index per ritornare in formato json la risposta di tutti i post con 200 come status OK
    public function index(){
        return response()->json(Product::all(),200);
    }

    //Funzione Store per inserire un prodotto nuovo.
    // In ingresso utilizziamo ProductRequest creato apositamente per la separazioni della responsabilità,
    // La validazione dei dati all'ingresso avviene direttamente in ingresso e dopo semplicemente
    public function store(ProductRequest $request){
        // Facciamo partire la funzione che li valida utilizzando l'oggetto ProductRequest
        $validateData = $request->validated();

        // Creiamo il prodotto con i dati arrivati dalla validazione
        $product = Product::create($validateData);

        // Ritorniamo la risposta con l'inserimento del prodotto e 201 di conferma
        return response()->json($product, 201);
    }

    // Funzione Update per aggiornare e modificare un prodotto già esistente
    // Laravel, grazie all'implicit Route Model Binding, guarda il parametro della route
    // e cerca il Product corrispondente -> Product $product al posto dell'id in ingresso e la ricerca, dentro
    // la funzione, del prodotto con quell'id specifico
    public function update(ProductRequest $request, Product $product){
            // Validazione dati in ingresso
           $validateData = $request->validated();

            // Aggiornamento del prodotto
            $product->update($validateData);

            // Ritorniamo il prodotto in json e 200 OK
            return response()->json($product, 200);
        
    }

    // Funzione Destroy per cancellare un prodotto specifico
    public function destroy(Product $product){
        // Se il prodotto esiste, elimino e mando messaggio di conferma
            $product->delete();
            return response()->json(['message' => 'Prodotto eliminato con successo'], 200);
    }

    public function co2Total(){
        // Calcolo la somma della colonna co2_saved direttamente con un metodo eloquent
        $sum_co2_total = Product::sum('co2_saved');
        return response()->json(['co2_total' => $sum_co2_total], 200);
    }
}
