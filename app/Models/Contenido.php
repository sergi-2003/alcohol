<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    use HasFactory;

    protected $table = 'contenidos';

    protected $fillable = [
        'tema_id',
        'titulo',
        'contenido',
        'imagen',
        'video_url',
        'iframe',
        'orden',
        'activo',
        'creado_por',
        'actualizado_por',
    ];

    protected $casts = [
        'orden' => 'integer',
        'activo' => 'boolean',
    ];

    /**
     * Tema al que pertenece el contenido
     */
    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_id');
    }

    /**
     * Usuario que creó el contenido
     */
    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'creado_por');
    }

    /**
     * Usuario que actualizó el contenido
     */
    public function actualizador()
    {
        return $this->belongsTo(Usuario::class, 'actualizado_por');
    }

    /**
     * Todos los recursos asociados al contenido
     */
    public function recursos()
    {
        return $this->hasMany(
            RecursoContenido::class,
            'contenido_id'
        )->orderBy('orden')
         ->orderBy('id');
    }

    /**
     * Imágenes múltiples asociadas al contenido
     */
    public function imagenes()
    {
        return $this->hasMany(
            RecursoContenido::class,
            'contenido_id'
        )
        ->where('tipo', 'imagen')
        ->where('activo', true)
        ->orderBy('orden')
        ->orderBy('id');
    }
}