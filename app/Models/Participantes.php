<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{
    protected $table = 'participantes';

    protected $fillable = [
        'usuario_id',
        'avatar_id',
        'nombre_completo',
        'tipo_documento',
        'numero_documento',
        'edad',
        'institucion',
        'grado',
        'correo',
        'telefono',
        'es_anonimo',
        'acepta_datos',
    ];

    protected $casts = [
        'es_anonimo' => 'boolean',
        'acepta_datos' => 'boolean',
    ];

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}