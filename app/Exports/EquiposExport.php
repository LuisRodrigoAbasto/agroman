<?php

namespace App\Exports;

use App\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;

class EquiposExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $table=Equipo::join('usuarios','equipos.usuario_id','=','usuarios.id')
        ->join('departamentos','equipos.departamento_id','=','departamentos.id')
        ->join('sucursals','equipos.sucursal_id','=','sucursals.id')
        ->where('equipos.estado','=','1')
        ->select('usuarios.nombre','equipos.telefono_interno','equipos.empresa','sucursals.nombre','departamentos.nombre',
        'usuarios.celular_corto','usuarios.email')
        // ->groupBy('usuarios.nombre','equipos.telefono_interno','equipos.empresa','sucursals.nombre','departamentos.nombre',
        // 'usuarios.celular_corto','usuarios.email')
        ->orderBy('equipos.empresa','desc')
        ->orderBy('sucursals.nombre','asc')
        ->orderBy('departamentos.nombre','asc')
        ->orderBy('usuarios.nombre','asc')
        ->get();

        return $table;
    }
}
