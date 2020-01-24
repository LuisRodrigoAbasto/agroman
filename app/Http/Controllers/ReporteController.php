<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Exports\CuentasExport;
use App\Exports\ServiciosExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    public function usuario()
    {
        return Excel::download(new CuentasExport,'usuarios.xlsx');
    }
    public function servicio(Request $request)
    {
        $table=new ServiciosExport();
        $table->setFechaInicio($request->fecha_inicio);
        $table->setFechaFin($request->fecha_fin);
        return Excel::download($table,'servicios.xlsx');
    }
}
