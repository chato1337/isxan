<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function listarPersonas(Request $request)
    {
      $buscar = $request->buscar;
      $criterio = $request->criterio;
      
      if ($buscar == '') {
        $persona = Persona::orderBy('id', 'desc')->paginate(10);
      }
      else{
        $persona = Persona::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'asc')->paginate(10);
      }

      return [
      'pagination' => [
          'total' => $persona->total(),
          'current_page' => $persona->currentPage(),
          'per_page' => $persona->perPage(),
          'last_page' => $persona->lastPage(),
          'from' => $persona->firstItem(),
          'to' => $persona->lastItem(),
      ], 'personas' => $persona];
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

    public function actualizarPersona(Request $request)
    {
      $validar_documento = $request->num_documento;

      $persona = Persona::findOrFail($request->id);
      $persona->nombre = $request->nombre;
      $persona->tipo_documento = $request->tipo_documento;
      if ($validar_documento==$persona->num_documento) {
        // si el documento es el mismo pues safa
      }
      else{
        // $persona->num_documento = $request->num_documento;
      }
      $persona->direccion = $request->direccion;
      $persona->departamento = $request->departamento;
      $persona->ciudad = $request->ciudad;
      $persona->telefono = $request->telefono;
      $persona->email = $request->email;
      $persona->save();
    }
}
