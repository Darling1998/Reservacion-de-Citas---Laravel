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
    

    /*     $horas=MedicoHorario::where('activo',true)
        ->where('dia',$dia)->where('medico_id',$medico_id)
        ->first([
            'hora_inicio_mñn',
            'hora_fin_mñn',
            'hora_inicio_tarde',
            'hora_fin_tarde'
        ]);
       // dd($horas);

       if(!$horas){
            return [];
       }
       $intervalosMñn= $this->getIntervalos($horas->hora_inicio_mñn,$horas->hora_fin_mñn);
       $intervalosTrd= $this->getIntervalos($horas->hora_inicio_tarde,$horas->hora_fin_tarde);
    
       $data =[];
       $data['mñn']=$intervalosMñn;
       $data['tarde']=$intervalosTrd; */

    //return $data;
    }

/*     private function getIntervalos($inicio,$fin){
        $inicio = new Carbon($inicio);
        $fin = new Carbon($fin);

        $intervalos=[];

        while($inicio < $fin){
            $intervalo=[];

            $intervalo['inicio']=$inicio->format('g:i A');
            $inicio->addMinutes(30);

            $intervalo['fin']=$inicio->format('g:i A');

            $intervalos[]=$intervalo;
        }
        return $intervalos;
    } */
}
