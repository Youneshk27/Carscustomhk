<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'taller_id', 'user_id', 'servicio_id', 'fecha_hora', 'descripcion', 
    ];

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
