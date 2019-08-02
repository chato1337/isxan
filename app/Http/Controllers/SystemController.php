<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\Department;
use App\Municipality;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('principal');
    }

    public function deptos(Request $request)
    {
      $deptos = Department::orderBy('id', 'asc')->get();

      return ['departamentos' => $deptos];
    }

    public function ciudades(Request $request)
    {
      $busqueda = $request->id;
      $ciudades = Municipality::where('department_id', $busqueda)->get();

      return ['ciudades' => $ciudades];
    }
}
