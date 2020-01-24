<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servidore;

class ServidorController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $pagina=$request->pagina;
        $table=Servidore::where('nombre','like','%'.$buscar.'%')
        ->where('estado','=','1')
        ->orderBy('id','desc')
        // ->with('Servidore')
         ->paginate($pagina);
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
        $table= new Servidore();
        $table->ip=$request->ip;
        $table->descripcion=$request->descripcion;
        $table->nombre=$request->nombre;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
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
        $table= Servidore::findOrfail($request->id);
        $table->ip=$request->ip;
        $table->descripcion=$request->descripcion;
        $table->nombre=$request->nombre;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
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
        $table=Servidore::find($id);
        $table->estado='0';
        $table->save();
    }
}
