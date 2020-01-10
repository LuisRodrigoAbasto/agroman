<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

    public function categoria (){
            return $this->belongsTo('App\Categoria','categoria_id');
            }

}