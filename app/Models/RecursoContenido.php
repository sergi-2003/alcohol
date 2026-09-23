<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoContenido extends Model
{
    use HasFactory;

    protected $table = 'recursos_contenido';

    protected $fillable = [
        'contenido_id',
        'tipo',
        'titulo',
        'ruta',
        'url',
        'configuracion',
        'orden',
        'activo',
    ];

    protected $casts = [
        'configuracion' => 'array',
        'orden' => 'integer',
        'activo' => 'boolean',
    ];

    public function contenido()
    {
        return $this->belongsTo(
            Contenido::class,
            'contenido_id'
        );
    }
}