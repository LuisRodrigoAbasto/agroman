<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    public function usuario (){
        return $this->belongsTo('App\Usuario','usuario_id');
        }
}
