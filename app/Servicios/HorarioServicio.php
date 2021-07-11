<?php

namespace App\Servicios;

use App\Interfaces\HorarioServicioInterface;
use App\Models\Cita;
use App\Models\MedicoHorario;
use Carbon\Carbon;

class HorarioServicio implements HorarioServicioInterface{

    private function getDiaDeFecha($fecha){
        
        $dateCarbon = new Carbon($fecha);
        //carbon trabaja asi: 0 es domingo y 6 es sabado
        
        $i = $dateCarbon->dayOfWeek;
        $dia =($i==0 ? 6 : $i-1);
        return $dia;
    }

    public function obtenerIntervalosDisponibles($fecha,$medico_id){
        
        //traemos todos los horarios de un medico
        $horas=MedicoHorario::where('activo',true)
        ->where('dia',$this->getDiaDeFecha($fecha))
        ->where('medico_id',$medico_id)
        ->first([
            'hora_inicio_mñn',
            'hora_fin_mñn',
            'hora_inicio_tarde',
            'hora_fin_tarde'
        ]);
       
       if($horas){
            $intervalosMñn= $this->obtenerIntervalos(
            $horas->hora_inicio_mñn,$horas->hora_fin_mñn,$fecha,$medico_id);
 
            $intervalosTrd= $this->obtenerIntervalos(
            $horas->hora_inicio_tarde,$horas->hora_fin_tarde,$fecha,$medico_id);
     
       }else{
        $intervalosMñn=[];
        $intervalosTrd=[];
       }
      
       $data =[];
       $data['mñn']=$intervalosMñn;
       $data['tarde']=$intervalosTrd;

       return $data;
    }

    private function obtenerIntervalos($inicio,$fin,$fecha,$medico_id){
        $inicio = new Carbon($inicio);
        $fin = new Carbon($fin);

        $intervalos=[];

        while($inicio < $fin){
            $intervalo=[];

            $intervalo['inicio']=$inicio->format('g:i A');

            //verificamos sino existe una cita con este medico en esta fecha y horario
            $exists = $this->disponibilidadIntervalo($fecha,$medico_id,$inicio);

            $inicio->addMinutes(30);

            $intervalo['fin']=$inicio->format('g:i A');

           // dd($exists);
            if($exists){
                $intervalos[]=$intervalo;
            }
           
        }
        return $intervalos;
    }

    //buscamos la citas asociadas al medico y la hora de inicio
    public function disponibilidadIntervalo($date, $medico_id, Carbon $inicio) {
        $exists = Cita::where('medico_id', $medico_id)
                ->where('fecha_cita', $date)
                ->where('hora_cita', $inicio->format('H:i:s'))
                ->exists();

        return !$exists; //disponibles si no existe
    }
}

