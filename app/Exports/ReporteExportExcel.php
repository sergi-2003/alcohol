<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteExportExcel implements FromCollection, WithHeadings
{
    public function __construct(private Collection $rows) {}

    public function collection(): Collection
    {
        return $this->rows->map(fn ($r) => [
            $r->id, $r->nombre_completo, $r->tipo_documento, $r->numero_documento,
            $r->edad, $r->institucion, $r->grado, $r->correo, $r->telefono,
            $r->rol_familiar, $r->municipio, $r->zona, $r->latitud, $r->longitud,
            $r->ubicacion_metodo, $r->es_anonimo ? 'Anónimo' : 'Identificado',
            $r->avatar, $r->escenas, $r->xp, $r->medallas, $r->aciertos,
            $r->total_preguntas, $r->porcentaje_aciertos, $r->created_at,
        ]);
    }

    public function headings(): array
    {
        return ['ID','Nombre','Tipo documento','Documento','Edad','Institución','Grado','Correo','Teléfono','Rol familiar','Municipio','Zona','Latitud','Longitud','Método ubicación','Estado','Avatar','Escenas','XP','Medallas','Aciertos','Preguntas','% aciertos','Fecha registro'];
    }
}
