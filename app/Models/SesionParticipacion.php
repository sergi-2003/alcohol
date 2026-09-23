<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionParticipacion extends Model
{
    protected $table = 'sesiones_participacion';

    protected $fillable = [
        'participante_id',
        'token',
        'fecha_inicio',
        'fecha_ultima_actividad',
        'activa',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_ultima_actividad' => 'datetime',
        'activa' => 'boolean',
    ];

    public function participante()
    {
        return $this->belongsTo(Participante::class);
    }
}