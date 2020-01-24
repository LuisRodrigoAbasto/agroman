<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Red;
use DB;
use Cuenta;

class RedController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $opcion=$request->opcion;
        $pagina=$request->pagina;
        $table=Red::where($opcion,'like','%'.$buscar.'%')
        ->orderBy('ip','desc')
        // ->with('categoria')
         ->paginate($pagina);

         foreach ($table as $key => $value) {
             if(!$value->table)
             if($value->table=='Cuenta'){
                $data=Cuenta::find($value->table_id)
                ->with('usuario');
                $value->descripcion=$data->usuario->nombre;
             }

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
    
    }/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  public function generar()
    //  {
    //     DB::beginTransaction();
    //     try{
    //    for($i=1;$i<=255;$i++)
    //    {
        

    //     // $table1= new Red();
    //     // $table1->ip='192.168.20.'.$i;
    //     // $table1->tabla='';
    //     // $table1->tabla_id='';
    //     // $table1->estado='1';
    //     // $table1->save();

    //     // $table= new Red();
    //     // $table->ip='192.168.10.'.$i;
    //     // $table->tabla='';
    //     // $table->tabla_id='';
    //     // $table->estado='1';
    //     // $table->save();

    //     // $table2= new Red();
    //     // $table2->ip='192.168.1.'.$i;
    //     // $table2->tabla='';
    //     // $table2->tabla_id='';
    //     // $table2->estado='1';
    //     // $table2->save();

    //     // $table3= new Red();
    //     // $table3->ip='192.168.5.'.$i;
    //     // $table3->tabla='';
    //     // $table3->tabla_id='';
    //     // $table3->estado='1';
    //     // $table3->save();
    //         }
    //         DB::commit();
    //     }
    //     catch (Exception $e){
    //         DB::rollBack();
    //     }
    //  }
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $table= new Red();
        $table->ip=$request->ip;
        $table->tabla=$request->tabla;
        $table->tabla_id=$request->tabla_id;
        $table->estado=$request->estado;
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
        DB::beginTransaction();
        try{
        if(!$request->ajax()) return redirect('/');
        $table= Red::findOrfail($request->id);
        $table->ip=$request->ip;
        $table->tabla=$request->tabla;
        $table->tabla_id=$request->tabla_id;
        $table->estado=$request->estado;
        $table->save();
        }
        catch (Exception $e){
            DB::rollBack();
        }
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
        $table=Red::find($id);
        $table->delete();
    }
}