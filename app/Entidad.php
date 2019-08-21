<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    protected $fillable = ['persona_id', 'id_rep_legal', 'estado', 'sub_anidado', 'direccion', 'correo'];

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
}
