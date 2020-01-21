<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipo;



class EquipoController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $pagina=$request->pagina;

        if($buscar=='')
        {
            $table=Equipo::where('equipos.estado','=','1')
            ->orderBy('equipos.id','desc')
            ->with('categoria')
            ->paginate($pagina);
        }
        else
        {
            $table=Equipo::join('categorias','equipos.categoria_id','=','categorias.id')
            ->where($opcion,'like','%'.$buscar.'%')
            ->where('equipos.estado','=','1')
            ->orderBy('equipos.id','desc')
            ->with('categoria')
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
    
    public function direccion(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
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
        if(!$request->ajax()) return redirect('/');
        $table= new Equipo();
        $table->categoria_id=$request->categoria_id;
        $table->serie=$request->serie;
        $table->descripcion=$request->descripcion;
        $table->stock=$request->stock;
        $table->tipo=$request->tipo;
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
        $table= Equipo::findOrfail($request->id);
        $table->categoria_id=$request->categoria_id;
        $table->serie=$request->serie;
        $table->descripcion=$request->descripcion;
        $table->stock=$request->stock;
        $table->tipo=$request->tipo; 
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