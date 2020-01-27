<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Usuario;
use App\Red;
use DB;

class CuentaController extends Controller
{
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $pagina=$request->pagina;

        if($buscar=='')
        {
            // $table=Cuenta::where('cuentas.estado','=','1')
            // ->orderBy('cuentas.id','desc')
            
            $table=Usuario::join('cuentas','usuarios.id','=','cuentas.usuario_id')
            ->join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where('usuarios.estado','=','1')
            ->where('cuentas.estado','=','1')
            ->select('cuentas.id','cuentas.usuario_id','usuarios.sucursal_id','usuarios.departamento_id',
            'usuarios.empresa_id','usuarios.nombre','usuarios.nombre','usuarios.email',
            'usuarios.password','usuarios.celular','usuarios.corto','usuarios.interno',
            'cuentas.ip','cuentas.usuario_sap','cuentas.password_sap','cuentas.usuario_ad','cuentas.password_ad','cuentas.telefono_ip')
            ->orderBy('cuentas.id','desc')
            // ->with('cuenta')
            ->with('empresa')
            ->with('sucursal')
            ->with('departamento')
            // ->with('usuario')
            ->paginate($pagina);
        }
        else{
            $table=Usuario::join('cuentas','usuarios.id','=','cuentas.usuario_id')
            ->join('empresas','usuarios.empresa_id','=','empresas.id')
            ->join('sucursals','usuarios.sucursal_id','=','sucursals.id')
            ->join('departamentos','usuarios.departamento_id','=','departamentos.id')
            ->where($opcion,'like','%'.$buscar.'%')
            ->where('usuarios.estado','=','1')
            ->where('cuentas.estado','=','1')
            ->select('cuentas.id','cuentas.usuario_id','usuarios.sucursal_id','usuarios.departamento_id',
            'usuarios.empresa_id','usuarios.nombre','usuarios.nombre','usuarios.email',
            'usuarios.password','usuarios.celular','usuarios.corto','usuarios.interno',
            'cuentas.ip','cuentas.usuario_sap','cuentas.password_sap','cuentas.usuario_ad','cuentas.password_ad','cuentas.telefono_ip')
            // ->orderBy('cuentas.id','desc')
            // ->with('cuenta')
            ->with('empresa')
            ->with('sucursal')
            ->with('departamento')
            // ->with('usuario')
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
        if(!$request->ajax()) return redirect('/');
        $opcion=$request->opcion;
        $table=[];
        if($opcion=="empresa")
        {
            $table=Cuenta::groupBy('empresa')
            ->get('empresa');

            foreach ($table as $fila) {
                $departamento=Cuenta::join('departamentos','cuentas.departamento_id','=','departamentos.id')
                ->groupBy('departamentos.id','departamentos.nombre')
                ->select('departamentos.id','departamentos.nombre')
                ->where('cuentas.estado','=','1')
                ->where('empresa','=',$fila->empresa)
                ->get();

                $fila->departamento=$departamento;
                foreach ($fila->departamento as $val) {
                    $val->data=Cuenta::where('departamento_id','=',$val->id)
                    ->where('empresa','=',$fila->empresa)
                    ->get();
                }
            }
        }
        return $table;
        
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
        $mensaje='';
        DB::beginTransaction();
        try{
        
        $red=Red::where('ip','=',$request->ip)->first();
        
        if($red->estado=='1')
        {
            $table= new Cuenta();
            $table->usuario_id=$request->usuario_id;
            $table->ip=$request->ip;
            $table->usuario_sap=$request->usuario_sap;
            $table->password_sap=$request->password_sap;
            $table->usuario_ad=$request->usuario_ad;
            $table->password_ad=$request->password_ad;
            $table->telefono_ip=$request->telefono_ip;
            $table->estado='1';
            $table->save();
            

            $data=Red::findOrfail($red->id);
            $data->tabla='Cuenta';
            $data->tabla_id=$table->id;
            $data->estado='0';
            $data->save();

            DB::commit();
            $mensaje='success';
        }
        else{
            DB::rollBack();
            $mensaje='error';
            throw('Error');
        }
        } 
        catch (Exception $e){
            DB::rollBack();
            $mensaje='error';
            
        }
        // return $mensaje;
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
        $mensaje='';
        DB::beginTransaction();
        try{
        
        $red=Red::where('ip','=',$request->ip)->first();
        
        if($red->estado=='1')
        {

        $table= Cuenta::find($request->id);

        $dat=Red::where('ip','=',$table->ip)->first();
        $dat->estado='1';
        $dat->tabla='';
        $dat->tabla_id='';
        $dat->save();

        $table->usuario_id=$request->usuario_id;
        $table->ip=$request->ip;
        $table->usuario_sap=$request->usuario_sap;
        $table->password_sap=$request->password_sap;
        $table->usuario_ad=$request->usuario_ad;
        $table->password_ad=$request->password_ad;
        $table->telefono_ip=$request->telefono_ip;
        $table->estado='1';
        $table->save();

        $data=Red::findOrfail($red->id);
        $data->tabla='Cuenta';
        $data->tabla_id=$table->id;
        $data->estado='0';
        $data->save();

            DB::commit();
            $mensaje='success';
        }
        else{
            
            DB::rollBack();
            $mensaje='error';
            throw('La IP esta Siendo Ocupada');
        }
        } 
        catch (Exception $e){
            DB::rollBack();
            $mensaje='error';
        }
        // return $mensaje;
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
        DB::beginTransaction();
        try{

        $table=Cuenta::findOrfail($id);
        
        $table->estado='0';
        $table->save();

        $dat=Red::where('ip','=',$table->ip)->first();
        $dat->estado='1';
        $dat->tabla='';
        $dat->tabla_id='';
        $dat->save();

        DB::commit();
        
    } 
    catch (Exception $e){
        DB::rollBack();
    }
    }
}

