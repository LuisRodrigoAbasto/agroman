<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function sucursal (){
        return $this->belongsTo('App\Sucursal','sucursal_id');
    }
    
    //     // public function getSucursalAttribute(){
    //     //     return $this->sucursal()->first(['nombre'])->nombre;
    //     // }
    
    public function departamento (){
        return $this->belongsTo('App\Departamento','departamento_id');
    }
    
    public function empresa(){
        return $this->belongsTo('App\Empresa','empresa_id');
    }

    public function cuenta(){
        return $this->hasOne('App\Cuenta');
    }
}
