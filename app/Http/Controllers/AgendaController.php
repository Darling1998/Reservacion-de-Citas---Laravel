<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialidad;
use Illuminate\Http\Request;

use App\Interfaces\HorarioServicioInterface;

class AgendaController extends Controller
{
    public function index(HorarioServicioInterface $horarioServ){

        $especialidades=Especialidad::all();
        $fechaProg = old('fecha_cita');
        $medicoId=old('medico_id');

        if($fechaProg && $medicoId){
            //dd($medicos);
            $intervalos=$horarioServ->obtenerIntervalosDisponibles($fechaProg,$medicoId);
        }else{
            $intervalos=null;
        }
        return view('admin.agenda.index',compact('intervalos','especialidades'));
    }

     public function show(Cita $citas){

        $todas= new Cita;
        
        
        return $todas->getAllCitas();;
    }

    public function store(Request $request){

        dd($request->all());

    }
}
