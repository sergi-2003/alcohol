<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionParticipacion extends Model
{
    protected $table = 'sesiones_participacion';

    protected $fillable = [
        'participante_id',
        'token',
        'identificador_anonimo',
        'fecha_inicio',
        'fecha_ultima_actividad',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_ultima_actividad' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function participante()
    {
        return $this->belongsTo(
            Participantes::class,
            'participante_id'
        );
    }
}