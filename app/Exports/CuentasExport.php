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
            'Usuario',
            'IP',
            'Interno',
            'Empresa',
            'Sucursal',
            'Departamento',
            'Corto',
            'Celular',
            'Email',
            'Usuario Sap',
            'Password Sap',
            'Usuario ad',
            'Password ad',
            'Telefono IP'
        ];
    }
    public function collection()
    {
        $table=Cuenta::join('usuarios','cuentas.usuario_id','=','usuarios.id')
            ->join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where('usuarios.estado','=','1')
            ->select('cuentas.id','cuentas.ip','usuarios.nombre as usuario','usuarios.interno','empresas.nombre as empresa',
            'sucursals.nombre as sucursal','departamentos.nombre as departamento','usuarios.corto',
            'usuarios.celular','usuarios.email','usuarios.password','cuentas.usuario_sap','cuentas.password_sap',
            'cuentas.usuario_ad','cuentas.password_ad','cuentas.telefono_ip')
            ->orderBy('empresas.nombre','asc')
            ->orderBy('sucursals.nombre','asc')
            ->orderBy('departamentos.nombre','asc')
        ->get();

        return $table;
    }
}
