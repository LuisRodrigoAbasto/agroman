<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $appends = ['sucursal','departamento'];

    public function sucursal (){
    return $this->belongsTo('App\sucursal','sucursal_id');
    }

    public function getSucursalAttribute(){
        return $this->sucursal()->first(['nombre'])->nombre;
    }

    public function departamento (){
        return $this->belongsTo('App\Departamento','departamento_id');
        }
    
        public function getDepartamentoAttribute(){
            return $this->departamento()->first(['nombre'])->nombre;
        }
}
