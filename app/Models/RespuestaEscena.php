<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RespuestaEscena extends Model
{
    protected $table = 'respuestas_escenas';

    protected $fillable = [
        'participante_id',
        'nivel',
        'pregunta',
        'respuesta',
        'correcta',
        'respondida_en',
    ];

    protected $casts = [
        'participante_id' => 'integer',
        'nivel' => 'integer',
        'pregunta' => 'integer',
        'respuesta' => 'integer',
        'correcta' => 'boolean',
        'respondida_en' => 'datetime',
    ];

    /**
     * Relación con el participante.
     */
    public function participante(): BelongsTo
    {
        return $this->belongsTo(
            Participantes::class,
            'participante_id'
        );
    }
}