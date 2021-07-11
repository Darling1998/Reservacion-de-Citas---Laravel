<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicoHorario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use \Spatie\Permission\Models\Role;

class HorarioController extends Controller
{
   
    private $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sabado','Domingo'];

   public function store(Request $request)
   {
     
      $per_medi=auth()->user()->id;
     
      $user = DB::table('medicos')
         ->join('people',   'medicos.persona_id','=','people.id')
         ->join('users',   'people.id','=','users.persona_id')->where('people.id','=',$per_medi)
         ->select('medicos.id as id_medico')
         ->first();

         $activo= $request->input('activo')?:[];//si no existe un dia activo es un arreglo vacio
         $hora_inicio_mñn= $request->input('hora_inicio_mñn');
         $hora_fin_mñn= $request->input('hora_fin_mñn');
         $hora_inicio_tarde= $request->input('hora_inicio_tarde');
         $hora_fin_tarde= $request->input('hora_fin_tarde');
   
         $alertas=[];
   
         for($i=0;$i<7;++$i){
   
            if($hora_inicio_mñn[$i]>=$hora_fin_mñn[$i]){
               $alertas[]='Las horas del turno de la mañana contienen inconsistencias en el dia '.$this->dias[$i].'.';
            }
            if($hora_inicio_tarde[$i]>$hora_fin_tarde[$i]){
               $alertas[]='Las horas del turno de la tarde contienen inconsistencias en el dia '.$this->dias[$i].'.';
            }
   
            MedicoHorario::updateOrCreate(
               [
                  'dia'=>$i,
                  'medico_id'=>$user->id_medico
               ],
               [  
                  'activo'=>in_array($i,$activo),//buscamos el dia ctivo dentro de la lista
                  'hora_inicio_mñn'=>$hora_inicio_mñn[$i],
                  'hora_fin_mñn'=>$hora_fin_mñn[$i],
                  'hora_inicio_tarde'=>$hora_inicio_tarde[$i],
                  'hora_fin_tarde'=>$hora_fin_tarde[$i]
               ]
            );
   
         }
   
         if(count($alertas)>0){
            //no inyecta ninguna variable a la vista el back ni el redirecto
            return back()->with(compact('alertas'));
         }
            $notificacion ='Horarios guardados correctamente';
            return back()->with(compact('notificacion'));
   }

   public function edit()
   {
      if(auth()->user()->hasRole('doctor')){
         
         $per_medi=auth()->user()->id;
         $user = DB::table('medicos')
               ->join('people',   'medicos.persona_id','=','people.id')
               ->join('users',   'people.id','=','users.persona_id')->where('people.id','=',$per_medi)
               ->select('medicos.id as id_medico')
               ->first();
         $dias_trabajo=MedicoHorario::where('medico_id',$user->id_medico)->get();


         if (count($dias_trabajo) > 0) {
            //mapeamos la coleccion para poder convertir la fecha
            $dias_trabajo->map(function ($diatrabajo) {
               $diatrabajo->hora_inicio_mñn = (new Carbon($diatrabajo->hora_inicio_mñn))->format('g:i A');
               $diatrabajo->hora_fin_mñn = (new Carbon($diatrabajo->hora_fin_mñn))->format('g:i A');
               $diatrabajo->hora_inicio_tarde = (new Carbon($diatrabajo->hora_inicio_tarde))->format('g:i A');
               $diatrabajo->hora_fin_tarde = (new Carbon($diatrabajo->hora_fin_tarde))->format('g:i A');
               return $diatrabajo;
            });
         }  
         else 
         {
               $dias_trabajo = collect();
               for ($i=0; $i<7; ++$i)
                   $dias_trabajo->push(new MedicoHorario());
         } 

         $dias = $this->dias;
         return view('medico.horarios.horario',compact('dias_trabajo','dias'));
      }

   }
   
}
