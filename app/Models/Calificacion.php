<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = [
        'user_id', 'taller_id', 'rating', 'comentario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}