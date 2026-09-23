<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatares';

    protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}