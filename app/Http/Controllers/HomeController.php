<?php

namespace App\Http\Controllers;

use App\Mail\NotificacionMailable;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function logout(){
        Auth::logout();

        return redirect('login');
    }



    public function index(){


        $users = DB::table('users')->where('estado','=','A')->count();
        $especialidades = DB::table('especialidads')->count();
        $pacientes = DB::table('pacientes')->where('estado','=','A')->count();
        $medicos = DB::table('medicos')->where('estado','=','A')->count();
    
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
    
    
        return view('home',compact('users','especialidades','pacientes','medicos','citasPorDia','citasCurso'));
    
       }
    
    
       public function notificar(Request $request){
           $correos= DB::table('users')
            ->join('people','users.persona_id','people.id')
            ->join('pacientes','people.id','pacientes.persona_id')
            ->select('email')->get();
    
            $infoMsj =[];
            $infoMsj['cuerpo']=$request->body;
            
           //dd($request,$correos);
            foreach($correos as $item){
    
                $correo = new NotificacionMailable($infoMsj);
                Mail::to($item)->send($correo);
            }
            return back();
    
       }
}
