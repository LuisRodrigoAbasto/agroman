<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table="sucursal";
    // public $timestamps = false;
    // protected $appends = ['categoria'];
    // public function categoria (){
    // return $this->belongsTo('App\Categoria','id_categoria');
    // }
    // public function getCategoriaAttribute(){
    //     return $this->categoria()->first(['nombre'])->nombre;
    // }

}
