<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $table=Usuario::where('usuario','like','%'.$buscar.'%')
        // ->with('departamento')
        // ->with('sucursal')
        ->where('estado','=','1')
        ->orderBy('id','desc')
        // ->with('categoria')
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
        // if(!$request->ajax()) return redirect('/');
        $table= new Usuario();
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->direccion_ip=$request->direccion_ip;
        $table->usuario=$request->usuario;
        $table->usuario_sap=$request->usuario_sap;
        $table->usuario_ad=$request->usuario_ad;
        $table->password_ad=$request->password_ad;
        $table->email_office=$request->email_office;
        $table->password_office=$request->password_office;
        $table->telefono_interno=$request->telefono_interno;
        $table->telefono_ip=$request->telefono_ip;
        $table->celular=$request->celular;
        $table->celular_corto=$request->celular_corto;
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
        $table= Usuario::findOrfail($request->id);
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->direccion_ip=$request->direccion_ip;
        $table->usuario=$request->usuario;
        $table->usuario_sap=$request->usuario_sap;
        $table->usuario_ad=$request->usuario_ad;
        $table->password_ad=$request->password_ad;
        $table->email_office=$request->email_office;
        $table->password_office=$request->password_office;
        $table->telefono_interno=$request->telefono_interno;
        $table->telefono_ip=$request->telefono_ip;
        $table->celular=$request->celular;
        $table->celular_corto=$request->celular_corto;
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
        $table=Usuario::findOrfail($id);
        $table->estado='0';
        $table->save();
    }
}
