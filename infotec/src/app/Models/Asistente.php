<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistente extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'evento_id',
    ];
}
