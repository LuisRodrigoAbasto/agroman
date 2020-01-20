<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use App\Usuario;
use App\Departamento;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $pagina=$request->pagina;
        $opcion=$request->opcion;
        if($buscar=='')
        {
            $table=Usuario::join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where('usuarios.estado','=','1')
            ->select('usuarios.id','usuarios.nombre','email','password','celular','corto','interno',
            'empresa_id','departamento_id','sucursal_id')
            ->orderBy($opcion,'asc')
            ->with('sucursal')
            ->with('departamento')
            ->with('empresa')
            ->paginate($pagina);
        }
        else
        {
            $table=Usuario::join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where($opcion,'like','%'.$buscar.'%')
            ->select('usuarios.id','usuarios.nombre','email','password','celular','corto','interno',
            'empresa_id','departamento_id','sucursal_id')
            ->where('usuarios.estado','=','1')
            ->orderBy($opcion,'asc')
            ->with('sucursal')
            ->with('departamento')
            ->with('empresa')
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
   
    public function principal(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $pagina=$request->pagina;
        $opcion=$request->opcion;

            $table=Usuario::join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where($opcion,'like','%'.$buscar.'%')
            ->select('usuarios.id','usuarios.nombre','email','password','celular','corto','interno',
            'empresa_id','departamento_id','sucursal_id')
            ->where('usuarios.estado','=','1')
            ->orderBy($opcion,'asc')
            ->with('sucursal')
            ->with('departamento')
            ->with('empresa')
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
    
    public function direccion(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $clientIP = \Request::ip();
        $clientIP = \Request::getClientIp(true);
        $clientIP = request()->ip();
        dd($request->ip());
        // return $clientIP;
    }

    public function select(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=Usuario::where('nombre','like','%'.$buscar.'%')
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
        $table= new Usuario();
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->empresa_id=$request->empresa_id;
        $table->nombre=$request->nombre;
        $table->email=$request->email;
        // $table->password=Hash::make($request->password);
        $table->password=$request->password;
        $table->celular=$request->celular;
        $table->corto=$request->corto;
        $table->interno=$request->interno;
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
        $table= Usuario::findOrfail($request->id);
        $table->sucursal_id=$request->sucursal_id;
        $table->departamento_id=$request->departamento_id;
        $table->empresa_id=$request->empresa_id;
        $table->nombre=$request->nombre;
        $table->email=$request->email;
        // $table->password=Hash::make($request->password);
        $table->password=$request->password;
        $table->celular=$request->celular;
        $table->corto=$request->corto;
        $table->interno=$request->interno;
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
