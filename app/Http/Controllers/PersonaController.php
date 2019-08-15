<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    public function listarPersonas(Request $request)
    {
      $buscar = $request->buscar;
      $criterio = $request->criterio;

      if ($buscar == '') {
        $persona = Persona::orderBy('id', 'asc')->get();
      }
      else{
        $persona = Persona::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'asc')->get();
      }

      return ['personas' => $persona];
    }
    public function registrarPersona(Request $request)
    {
      $persona = new Persona();
      $persona->nombre = $request->nombre;
      $persona->tipo_documento = $request->tipo_documento;
      $persona->num_documento = $request->num_documento;
      $persona->direccion = $request->direccion;
      $persona->departamento = $request->departamento;
      $persona->ciudad = $request->ciudad;
      $persona->telefono = $request->telefono;
      $persona->email = $request->email;
      $persona->save();
    }
}
