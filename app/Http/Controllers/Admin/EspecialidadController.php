<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades= Especialidad::all();
         return view('admin.especialidades.index',compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.especialidades.create');
    }


    public function store(Request $request)
    {
        $request->validate(['nombre'=>'required']);

        $especialidade=Especialidad::create($request->all());

    
        return redirect()->route('admin.especialidades.index')->with('info','Especialidad creada exitosamente');
    }

    
    public function show(Especialidad $especialidade)
    {
        return view('admin.especialidades.show',compact('especialidade'));
    }

   
    public function edit(Especialidad $especialidade)
    {
        
        return view('admin.especialidades.edit',compact('especialidade'));
    }

   
    public function update(Request $request,Especialidad $especialidade){

        $reglas=[
            'nombre'=>'required|min:4'
        ];

        $alertas=[
            'nombre.required'=>'Ingrese un nombre',
            'nombre.min'=>'Ingresar minimo 4 caracteres'
        ];

        $this->validate($request,$reglas,$alertas);

        $especialidade->nombre = $request->input('nombre');
        $especialidade->descripcion = $request->input('descripcion');
        $especialidade->save();
        return redirect()->route('admin.especialidades.edit',$especialidade)->with('info','La especialidad se ha actualizado correctamente');
    }

    
    public function destroy(Especialidad $especialidade)
    {
       /*  dd($especialidade->citas);
        $especialidade->delete();
        return redirect()->route('admin.especialidades.index')->with('info','Especialidad eliminada correctamente'); */


        $status='';
        $count=0;
       
    
        // Contamos los registros en las relaciones
        $count+=count($especialidade->citas);
        // Comprobamos si existen registros 
        if($count>0) {
            $status =  'No se puede Eliminar existen registros relacionados';
           
        } else {
            // si no hay registros eliminamos
            $especialidade->delete();
            $status =  'Eliminado correctamente';
          
        }
    
        return redirect()->route('admin.especialidades.index')
            ->with('info', $status);


    }

}
