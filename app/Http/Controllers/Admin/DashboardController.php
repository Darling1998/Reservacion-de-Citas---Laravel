<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotificacionMailable;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
   public function index(){


    $users = DB::table('users')->count();
    $especialidades = DB::table('especialidads')->count();
    $pacientes = DB::table('pacientes')->count();
    $medicos = DB::table('medicos')->count();

    $citasPorDia= Cita::select([
        DB::raw('DAYOFWEEK(fecha_cita) as dias'),
        DB::raw('COUNT(*) as count')
        
        ])->groupBy(DB::raw('DAYOFWEEK(fecha_cita)'))
    /* ->where('estado','C') */
    ->pluck('count');

   
    $citasCurso= DB::table('citas')->select('people.nombres','people.apellidos','especialidads.nombre as nombreEspe','citas.estado','citas.id')
    ->join('pacientes','citas.paciente_id','pacientes.id')
    ->join('people','pacientes.persona_id','people.id')
    ->join('especialidads','citas.especialidad_id','especialidads.id')
    ->where('citas.estado','=','C')->take(5)->get();

    //dd($citasCurso);


    return view('admin.dashboard',compact('users','especialidades','pacientes','medicos','citasPorDia','citasCurso'));

   }


   public function notificar(Request $request){
       $correos= DB::table('users')
        ->join('people','users.persona_id','people.id')
        ->join('pacientes','people.id','pacientes.persona_id')
        ->select('email')->get();

        $infoMsj =[];
        $infoMsj['cuerpo']=$request->body;
        
        dd($request,$correos);
        foreach($correos as $item){

            $correo = new NotificacionMailable($infoMsj);
            Mail::to($item)->send($correo);
        }
       // 

   }
}
