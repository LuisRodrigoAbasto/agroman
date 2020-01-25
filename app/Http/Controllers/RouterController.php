<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Router;
use App\Red;
use DB;

class RouterController extends Controller
{
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
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
        DB::beginTransaction();
        try{
        
        $red=Red::where('ip','=',$request->ip)->first();
        
        if($red->estado=='1')
        {
        $table= new Router();
        $table->ip=$request->ip;
        $table->wifi=$request->wifi;
        $table->password_wifi=$request->password_wifi;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
        $table->descripcion=$request->descripcion;
        $table->estado='1';
        $table->save();

        $data=Red::findOrfail($red->id);
        $data->tabla='Router';
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

        $table= Router::find($request->id);

        $dat=Red::where('ip','=',$table->ip)->first();
        $dat->tabla='';
        $dat->tabla_id='';
        $dat->estado='1';
        $dat->save();

        $table->ip=$request->ip;
        $table->wifi=$request->wifi;
        $table->password_wifi=$request->password_wifi;
        $table->usuario=$request->usuario;
        $table->password=$request->password;
        $table->descripcion=$request->descripcion;
        $table->estado='1';
        $table->save();

        $data=Red::findOrfail($red->id);
        $data->tabla='Router';
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
        return $mensaje;
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
        $table=Router::find($id);
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
        $mensaje='error';
    }
    }
}