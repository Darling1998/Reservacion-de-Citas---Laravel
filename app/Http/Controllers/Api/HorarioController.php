<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioServicioInterface;
use Illuminate\Http\Request;

class HorarioController extends Controller
{

    public function horas(Request $request, HorarioServicioInterface $horarioServicio){
        
        $reglas=[
            'medico_id'=>'required|exists:medicos,id'
        ];
        $request->validate($reglas);
        $fecha=$request->input('fecha');
        $medico_id=$request->input('medico_id');
       return $horarioServicio->obtenerIntervalosDisponibles($fecha,$medico_id);

    }

}
