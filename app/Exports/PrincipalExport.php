<?php

namespace App\Exports;

use App\Usuario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrincipalExport implements FromCollection,WithHeadings
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
        $table=Usuario::join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where('usuarios.estado','=','1')
            ->select('usuarios.nombre as usuario','empresas.nombre as empresa',
            'sucursals.nombre as sucursal','departamentos.nombre as departamento','usuarios.interno',
            'usuarios.celular','usuarios.corto','usuarios.email')
            ->orderBy('empresas.nombre','asc')
            ->orderBy('sucursals.nombre','asc')
            ->orderBy('departamentos.nombre','asc')
        ->get();

        return $table;
    }
}
