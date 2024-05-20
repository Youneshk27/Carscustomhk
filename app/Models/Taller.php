<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nombre', 'direccion', 'contacto', 'descripcion', 'foto', 'lat', 'lng', 'ciudad', 'horario_apertura', 'horario_cierre', 'dias_laborables',
    ];

    protected $casts = [
        'dias_laborables' => 'array',
    ];

    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    protected $table = 'talleres'; // Asegúrate de especificar la tabla correcta

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->calificaciones()->avg('rating');
    }
}