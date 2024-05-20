<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'taller_id', 'nombre', 'descripcion', 'imagen', 'precio',
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}
