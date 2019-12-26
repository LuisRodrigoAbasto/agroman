<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = ['id'];
    public function sucursal (){
        return $this->belongsTo('App\Sucursal','sucursal_id');
        }
    
    //     // public function getSucursalAttribute(){
    //     //     return $this->sucursal()->first(['nombre'])->nombre;
    //     // }
    
    public function departamento (){
            return $this->belongsTo('App\Departamento','departamento_id');
            }
        
    //         // public function getDepartamentoAttribute(){
    //         //     return $this->departamento()->first(['nombre'])->nombre;
    //         // }
    public function usuario (){
                return $this->belongsTo('App\Usuario','usuario_id');
                }
}
