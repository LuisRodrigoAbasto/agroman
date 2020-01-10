<?php

namespace App\Exports;

use App\Cuenta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CuentasExport implements FromCollection,WithHeadings
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
        $table=Cuenta::join('usuarios','cuentas.usuario_id','=','usuarios.id')
        ->join('departamentos','cuentas.departamento_id','=','departamentos.id')
        ->join('sucursals','cuentas.sucursal_id','=','sucursals.id')
        ->where('cuentas.estado','=','1')
        ->select('usuarios.nombre as usuario','cuentas.telefono_interno','cuentas.empresa as empresa','sucursals.nombre as sucursal','departamentos.nombre as departamento',
        'usuarios.celular','usuarios.celular_corto','usuarios.email')
        // ->groupBy('usuarios.nombre','cuentas.telefono_interno','cuentas.empresa','sucursals.nombre','departamentos.nombre',
        // 'usuarios.celular_corto','usuarios.email')
        ->orderBy('cuentas.empresa','desc')
        ->orderBy('departamentos.nombre','asc')
        ->orderBy('sucursals.nombre','asc')
        
        // ->orderBy('usuarios.nombre','asc')
        ->get();

        return $table;
    }
}
