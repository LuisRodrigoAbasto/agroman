<?php

namespace App\Exports;

use App\Servicio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiciosExport implements FromCollection,WithHeadings
{
    private $fecha_inicio;
    private $fecha_fin;

    public function setFechaInicio(string $valor)
    {
        $this->fecha_inicio = $valor;
    }
    public function setFechaFin(string $valor)
    {
        $this->fecha_fin = $valor;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nombre Usuario',
            'Empresa',
            'Sucursal',
            'Departamento',
            'Fecha',
            'Descripcion'
        ];
    }

    public function collection()
    {
        $table=Servicio::join('usuarios','servicios.usuario_id','=','usuarios.id')
            ->join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where('servicios.fecha','>=',$this->fecha_inicio)
            ->where('servicios.fecha','<=',$this->fecha_fin)
            ->select('usuarios.nombre as usuario','empresas.nombre as empresa','sucursals.nombre',
            'departamentos.nombre as departamento',
            'servicios.fecha','servicios.descripcion')
            ->orderBy('servicios.fecha','desc')
        ->get();

        return $table;
    }
}
