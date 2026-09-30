<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Con fillable andiamo a definire queli attributi possono essere assegnati tramite mass assignment
#[Fillable('name', 'co2_saved')]
class Product extends Model
{
    use HasFactory;

    // Con la funzione casts andiamo a definire che co2_saved deve essere un integer, la stringa di name viene gestita automaticamente
    protected function casts(): array
    {
        return [
            'co2_saved' => 'integer',
        ];
    }
}
