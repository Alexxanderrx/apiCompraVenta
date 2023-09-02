<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'stock_inicial',
        'stock_actual',
        'fecha_produccion',
        'fecha_vencimiento'
    ];
}
