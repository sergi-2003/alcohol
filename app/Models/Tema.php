<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = 'temas';

    protected $fillable = [
        'campaña_id',
        'titulo',
        'slug',
        'descripcion_corta',
        'imagen',
        'icono',
        'orden',
        'activo',
    ];

    protected $casts = [
        'campaña_id' => 'integer',
        'orden' => 'integer',
        'activo' => 'boolean',
    ];

    public function contenidos()
    {
        return $this->hasMany(Contenido::class, 'tema_id');
    }
}