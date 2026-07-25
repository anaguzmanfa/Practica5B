<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponente extends Model
{
    protected $fillable = [
        'nombre',
        'biografia',
        'especialidad',
    ];
}
