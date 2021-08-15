<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ReporteController extends Controller
{
    public function index(){

        $cantxmes = Cita::select (
            DB::raw('MONTH(created_at) as mes'), 
            DB::raw('COUNT(1) as cantidad')
        )->groupBy('mes')->get()->toArray();

        $cantidades =array_fill(0,12,0);

        foreach ($cantxmes as $cantidadMes){
            $inicio = $cantidadMes['mes']-1;
            $cantidades[$inicio]=$cantidadMes['cantidad'];
        }

        $actual=Carbon::now();
        $inicio = $actual->subYear()->format('Y-m-d');
        $fin=$actual->format('Y-m-d');

        $inicioEspe = $actual->subYear()->format('Y-m-d');
        $finEspe=$actual->format('Y-m-d');

        $fecha_actual=date('Y-m-d');
        $desde =  date('Y-m-d',strtotime($fecha_actual." -6 month")); ;
        $citas = DB::table('citas')
            ->join('especialidads', 'citas.especialidad_id', '=', 'especialidads.id')
            ->select( array('especialidads.nombre',DB::raw('count(especialidad_id) as total')))
            ->whereBetween('fecha_cita',[$desde,$fecha_actual])
            ->groupBy('especialidad_id','especialidads.nombre')
            ->get(); 

            $array = json_decode(json_encode($citas), true);
            
           // dd(json_encode($citas));
         $especial =[];
          foreach($array as $cita){
            $especial[]=['name'=>$cita['nombre'],'y'=>$cita['total']];
          }

        return view('admin.reportes.index',compact('cantidades','inicio','fin','inicioEspe','finEspe','especial'));
    }


    public function medicosJson(Request $request){
        $inicio=$request->input('inicio');
        $fin=$request->input('fin');;
      /*           $nombres= DB::table('medicos')
                 ->join('people',   'medicos.persona_id','=','people.id')
                ->select(DB::raw("CONCAT(people.nombres,' ',people.apellidos) as nombre_medico"))
                ->take(3)->get();  */
                /* DB::raw("( SELECT people.nombres FROM people where people.id= persona_id) as nombres") */
         $medicos = Medico::doctores()->select(DB::raw("( SELECT people.nombres FROM people where people.id= persona_id) as nombres"))
            ->withCount([
                'citasAtendidas'=>function($query) use ($inicio,$fin){
                $query->whereBetween('fecha_cita',[$inicio,$fin]);
            },
                'citasCanceladas' => function ($query) use ($inicio, $fin) {
                    $query->whereBetween('fecha_cita', [$inicio, $fin]);
                } 
            
            ])
            ->orderBy('citas_atendidas_count','desc')
            ->take(3)->get();


        $data =[];
        $data['categorias']=$medicos->pluck('nombres');
        $series=[];
        //citas atendidas
        $series1['name']='Citas Atendidas';
        $series1['data'] = $medicos->pluck('citas_atendidas_count');

        //citas canceladas
        $series2['name'] = 'Citas Canceladas';
    	$series2['data'] = $medicos->pluck('citas_canceladas_count'); 

        $series[] = $series1;
        $series[] = $series2;
        $data['series']=$series; 
        return $data;
    }


    public function especialidadesDemandadas(){
        $actual=Carbon::now();
        $inicio = $actual->subYear()->format('Y-m-d');
        $fin=$actual->format('Y-m-d');
      
        return view('admin.reportes.especialidades',compact('inicio','fin'));
    }

     public function especialidadesDemandadasJson(Request $request){
        $inicio=$request->input('inicio');
        $fin=$request->input('fin');

        $citas = DB::table('citas')
        ->join('especialidads', 'citas.especialidad_id', '=', 'especialidads.id')
        ->select( array('especialidads.nombre',DB::raw('count(especialidad_id) as total')))
        ->whereBetween('fecha_cita',[$inicio,$fin])
        ->groupBy('especialidad_id','especialidads.nombre')
        ->get(); 

        $data =[];
        $data['categorias']=$citas->pluck('nombre');
        $series=[];
    
        $series1['name']='Citas Atendidas';
        $series1['data'] = $citas->pluck('total');
        $series[] = $series1;
        $data['series']=$series;
        

        return $data;
   
    }
}

