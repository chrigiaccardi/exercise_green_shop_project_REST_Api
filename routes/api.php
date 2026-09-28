<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Creiamo Le RestAPI CRUD
// Index: Riceve tutti i prodotti
Route::get('/products', [ProductController::class, 'index'])->name('get_products');

// Store: Inserisce un nuovo prodotto
Route::post('/products', [ProductController::class, 'store'])->name('new_product');

// co2_total: API per la restituzione della somma totale di co2 risparmiata
// Inseriamo prima la Route statica così siamo sicuri che non abbiamo interferenze con quelle dimamiche {product}
Route::get('/products/co2-total',[ProductController::class, 'co2_total'])->name('co2_total');

// In Update e Destroy inseriamo una validazione in più (route contraint), il valore dinamico product deve essere
// un numero con il metodo where, così siamo ancora più sicuri che non ci sia conflitto
// con la route statica co2_total
// Update: Aggiorna il singolo prodotto
Route::put('/products/{product}', [ProductController::class, 'update'])->where('product', '[0-9]+')->name('update_product');

// Destroy: Cancella un prodotto già esistente
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->where('product', '[0-9]+')->name('delete_product');
