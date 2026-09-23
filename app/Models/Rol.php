<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre',
    ];

    public function usuarios()
    {
        return $this->hasMany(
            Usuario::class,
            'rol_id'
        );
    }

    public function permisos()
    {
        return $this->belongsToMany(
            Permiso::class,
            'rol_permiso',
            'rol_id',
            'permiso_id'
        )->withTimestamps();
    }

    public function tienePermiso($slug)
    {
        return $this->permisos()
            ->where('slug', $slug)
            ->exists();
    }
}