<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\User;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $table=Servicio::join('usuarios','servicios.usuario_id','usuarios.id')
        ->join('users','servicios.user_id','users.id')
        ->join('empresas','usuarios.empresa_id','=','empresas.id')
        ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
        ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
        ->where($opcion,'like','%'.$buscar.'%')
        ->where('servicios.estado','=','1')
        ->where('usuarios.estado','=','1')
        ->select('servicios.id','servicios.usuario_id','servicios.user_id','servicios.fecha','servicios.descripcion',
        'departamentos.nombre as departamento','empresas.nombre as empresa','sucursals.nombre as sucursal')
        ->orderBy('servicios.fecha','desc')
        ->with('usuario')
        ->with('user')
         ->paginate(10);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $table= new Servicio();
        $table->user_id=auth()->id();
        $table->usuario_id=$request->usuario_id;        
        $table->fecha=$request->fecha;
        $table->descripcion=$request->descripcion;
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
        if(!$request->ajax()) return redirect('/');
        $table= Servicio::findOrfail($request->id);
        $table->usuario_id=$request->usuario_id;
        // $table->user_id=auth()->id();
        $table->fecha=$request->fecha;
        $table->descripcion=$request->descripcion;
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
        $table=Servicio::find($id);
        $table->estado='0';
        $table->save();
    }
}