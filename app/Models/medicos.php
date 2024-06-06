<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicos extends Model
{
    use HasFactory;
    protected $fillable = [
        'idusuario',
        'bilhete',
        'departamento',
        'cargo',
        'comeco_turno',
        'fim_turno',
    ];
}
