<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index(){
        return view('admin.especialidades.index');
    }
    public function create(){
        return view('admin.especialidades.create');
    }

    public function edit(/* Especialidad */ $especialidad){
        
        return view('admin.especialidades.edit',compact('especialidad'));
    }

    public function store(Request $request){
        $reglas=[
            'nombre'=>'required|min:4|unique:especialidads,nombre'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);
        //$especialidad = new Especialidad();
/*         $especialidad->nombre = $request->input('nombre');
        $especialidad->descripcion = $request->input('descripcion');
        $especialidad->save(); */

        $notificacion = 'La especialidad se ha registrado correctamente.';
        return redirect('/especialidades')->with(compact('notificacion'));
    
    }
}
