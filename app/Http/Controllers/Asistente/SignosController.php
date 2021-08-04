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
        ->join('hce','pacientes.id','=','hce.paciente_id')
        ->where('citas.id','=',$id)
        ->select('hce.id as hce', 'citas.*')
        ->get()->first();
       
       //dd($citas);
        return view("asistente.consulta.create",compact('citas'));
    }



    public function guardarSignos(Request $request){

     // dd($request);
        if ($request->hce_id===null) {
            $nuevoHce= Hce::create(['paciente_id' => $request->paciente_id]);
            Consulta::updateOrCreate(
                [
                   'cita_id'=>$request->cita_id
                ],
                [  
                    'observacion'=>$request->observacion,
                    'peso'=>$request->peso,
                    'presion'=>$request->presion,
                    'talla'=>$request->talla,
                    'temperatura'=>$request->temperatura,
    
                    'hce_id'=> $nuevoHce->id ,
                ]
             );
        }else{
            Consulta::updateOrCreate(
                [
                   'cita_id'=>$request->cita_id
                ],
                [  
                    'observacion'=>$request->observacion,
                    'peso'=>$request->peso,
                    'presion'=>$request->presion,
                    'talla'=>$request->talla,
                    'temperatura'=>$request->temperatura,
    
                    'hce_id'=> $request->hce_id ,
                ]
             );
        }

        $notificacion ='Signos registrados correctamente';
        return back()->with(compact('notificacion'));
        

       
    }
}
