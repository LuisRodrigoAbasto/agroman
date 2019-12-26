<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Usuario;
// use App\Departamento;
// use App\Sucursal;
use App\Equipo;



class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $pagina=$request->pagina;

        if($buscar=='')
        {
            $table=Equipo::where('equipos.estado','=','1')
            ->orderBy('equipos.id','desc')
            ->with('usuario')
            ->with('sucursal')
            ->with('departamento')
            ->paginate($pagina);
        }
        else
        {
        $table=Equipo::join('usuarios','equipos.usuario_id','=','usuarios.id')
        ->join('departamentos','equipos.departamento_id','=','departamentos.id')
        ->join('sucursals','equipos.sucursal_id','=','sucursals.id')
        ->where('usuarios.nombre','like','%'.$buscar.'%')
        ->where('equipos.estado','=','1')
        ->select('equipos.id','equipos.sucursal_id','equipos.departamento_id','equipos.usuario_id',
        'equipos.empresa','equipos.ip','equipos.usuario_sap','equipos.password_sap','equipos.usuario_ad',
        'equipos.password_ad','equipos.telefono_interno','equipos.telefono_ip','equipos.estado')
        ->with('usuario')
        ->with('sucursal')
        ->with('departamento')
        ->paginate($pagina);
        }
        
        return [
            'pagination' => [
                'total'        => $table->total(),
                'current_page' => $table->currentPage(),
                'per_page'     => $table->perPage(),
                'last_page'    => $table->lastPage(),
                'from'         => $table->firstItem(),
                'to'           => $table->lastItem(),
            ],
            'table' => $table
        ];
    
    }
    public function orden(Request $request)
    {
        $opcion=$request->opcion;
        $table=[];
        if($opcion=="empresa")
        {
            $table=Equipo::groupBy('empresa')
            ->get('empresa');

            foreach ($table as $fila) {
                $departamento=Equipo::join('departamentos','equipos.departamento_id','=','departamentos.id')
                ->groupBy('departamentos.id','departamentos.nombre')
                ->select('departamentos.id','departamentos.nombre')
                ->where('equipos.estado','=','1')
                ->where('empresa','=',$fila->empresa)
                ->get();

                $fila->departamento=$departamento;
                foreach ($fila->departamento as $val) {
                    $val->data=Equipo::where('departamento_id','=',$val->id)
                    ->where('empresa','=',$fila->empresa)
                    ->get();
                }
            }
        }
        return $table;
        
    }
    
    public function direccion(Request $request)
    {
        
        $clientIP = \Request::ip();
        $clientIP = \Request::getClientIp(true);
        $clientIP = request()->ip();
        dd($request->ip());
        // return $clientIP;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $table= new Equipo();
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->usuario_id=$request->usuario_id;
        $table->empresa=$request->empresa;
        $table->ip=$request->ip;
        $table->usuario_sap=$request->usuario_sap;
        $table->password_sap=$request->password_sap;
        $table->usuario_ad=$request->usuario_ad;
        $table->password_ad=$request->password_ad;
        $table->telefono_interno=$request->telefono_interno;
        $table->telefono_ip=$request->telefono_ip;
        $table->estado='1';
        $table->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table= Equipo::findOrfail($request->id);
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->usuario_id=$request->usuario_id;
        $table->empresa=$request->empresa;
        $table->ip=$request->ip;
        $table->usuario_sap=$request->usuario_sap;
        $table->password_sap=$request->password_sap;
        $table->usuario_ad=$request->usuario_ad;
        $table->password_ad=$request->password_ad;
        $table->telefono_interno=$request->telefono_interno;
        $table->telefono_ip=$request->telefono_ip;
        $table->estado='1';
        $table->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!$request->ajax()) return redirect('/');
        $table=Equipo::findOrfail($id);
        $table->estado='0';
        $table->save();
    }
}
