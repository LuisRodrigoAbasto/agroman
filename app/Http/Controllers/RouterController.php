<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Router;

class RouterController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $pagina=$request->pagina;
        $table=Router::where($opcion,'like','%'.$buscar.'%')
        ->where('estado','=','1')
        ->orderBy('id','desc')
        // ->with('Router')
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

    public function select(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=Router::where('nombre','like','%'.$buscar.'%')
        ->where('estado','=','1')
        ->take(10)
        ->get();
        return ['table' => $table];
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
        $table= new Router();
        $table->ip=$request->ip;
        $table->wifi=$request->wifi;
        $table->password_wifi=$request->password_wifi;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
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
        $table= Router::findOrfail($request->id);
        $table->ip=$request->ip;
        $table->wifi=$request->wifi;
        $table->password_wifi=$request->password_wifi;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
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
        $table=Router::find($id);
        $table->estado='0';
        $table->save();
    }
}