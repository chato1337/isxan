<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

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
}
