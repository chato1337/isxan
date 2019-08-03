<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombre', 'tipo_documento', 'num_documento', 'direccion', 'departamento', 'ciudad', 'telefono', 'email'];
}
