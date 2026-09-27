<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // Con la funziona up andiamo ad attivare la creazione della tabella con la seguente struttura
    public function up(): void
    {
         Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('co2_saved')->check('co2_saved >= 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    // Con la funziona down torniamo indietro nel caso di errore cancellando la tabella completa
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
