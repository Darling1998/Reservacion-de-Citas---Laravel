<?php

namespace App\Http\Controllers\Asistente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Cita;
use App\Models\Hce;
use Illuminate\Support\Facades\DB;

class SignosController extends Controller
{

    public function create($id)
    {
        //$citas = Cita::findOrFail($id);

        $citas = DB::table('citas')
        ->join('pacientes','citas.paciente_id','=','pacientes.id')
        ->where('citas.id','=',$id)
        ->select('citas.*')
        ->get()->first();
       
       //dd($citas);
        return view("asistente.consulta.create",compact('citas'));
    }



    public function guardarSignos(Request $request){

     // dd($request);
        
        
        $request->validate([
            'talla'=>['required'],
            'peso'=>['required'],
            'presion'=>['required'],
            'temperatura'=>['required'],
        ]);

        Consulta::updateOrCreate(
        [
            'cita_id'=>$request->cita_id
        ],
        [  
            'motivo'=>$request->observacion,
            'peso'=>$request->peso,
            'presion'=>$request->presion,
            'talla'=>$request->talla,
            'temperatura'=>$request->temperatura,
        ]
        );
        

        $notificacion ='Signos registrados correctamente';
        return back()->with(compact('notificacion'));
        

       
    }
}
