<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recepcionistas extends Model
{
    use HasFactory;
    protected $fillable = [
        'idusuario',
        'bilhete',
        'comeco_turno',
        'fim_turno',
    ];
}
