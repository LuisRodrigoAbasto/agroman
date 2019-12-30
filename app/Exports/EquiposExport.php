<?php

namespace App\Exports;

use App\Equipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquiposExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nombre Usuario',
            'Interno',
            'Empresa',
            'Sucursal',
            'Departamento',
            'Celular',
            'Corto',
            'email',
        ];
    }
    public function collection()
    {
        $table=Equipo::join('usuarios','equipos.usuario_id','=','usuarios.id')
        ->join('departamentos','equipos.departamento_id','=','departamentos.id')
        ->join('sucursals','equipos.sucursal_id','=','sucursals.id')
        ->where('equipos.estado','=','1')
        ->select('usuarios.nombre as usuario','equipos.telefono_interno','equipos.empresa as empresa','sucursals.nombre as sucursal','departamentos.nombre as departamento',
        'usuarios.celular','usuarios.celular_corto','usuarios.email')
        // ->groupBy('usuarios.nombre','equipos.telefono_interno','equipos.empresa','sucursals.nombre','departamentos.nombre',
        // 'usuarios.celular_corto','usuarios.email')
        ->orderBy('equipos.empresa','desc')
        ->orderBy('departamentos.nombre','asc')
        ->orderBy('sucursals.nombre','asc')
        
        // ->orderBy('usuarios.nombre','asc')
        ->get();

        return $table;
    }
}
