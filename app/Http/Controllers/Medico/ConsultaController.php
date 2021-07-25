<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Antecedentes;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Diagnostico;
use COM;
use Illuminate\Support\Facades\DB;
class ConsultaController extends Controller
{

    public function edit($id){

        $citas = DB::table('citas')
        ->join('pacientes','citas.paciente_id','=','pacientes.id')
        ->join('hce','pacientes.id','=','hce.paciente_id')
        ->where('citas.id','=',$id)
        ->select('citas.id as cita_id','hce.id as hce', 'citas.descripcion as motivo')
        ->get()->first();

        $consulta=DB::table('consulta')
        ->where('cita_id','=',$id)
        ->get()->first();;
        //cargarmos el select con CIE-10
        $diagnosticos= Diagnostico::all();

        $id_diagnosticos = DB::table('diagnosticos')
        ->join('consulta_diagnostico','diagnosticos.id','=','consulta_diagnostico.diagnostico_id')
        ->where('consulta_diagnostico.consulta_id',$consulta->id)
        ->select('consulta_diagnostico.diagnostico_id as id')
        ->get()->pluck('id');
        return view('medico.consulta.index',compact('diagnosticos','citas','consulta','id_diagnosticos'));
    }

/* 
    public function show( $id){

        $info= DB::table('citas')
        ->select('people.cita_id as cita_id','people.hce as hce','people.motivo as sexo','pacientes.id as paciente_id')
        ->join('pacientes',   'citas.paciente_id','=','pacientes.id')
        ->join('people',   'people.id','=','pacientes.persona_id')
        ->where('citas.id','=',$id)
        ->get()->toArray();

        $affected = Cita::findorFail($id);
        $idp=$affected->paciente_id;
       
        $existe = DB::table('pacientes')
           ->whereExists(function ($query) use($idp) {
               $query->select(DB::raw(1))
                     ->from('antecedentes')
                     ->where('antecedentes.paciente_id',$idp);
           })
           ->get();

     return view('medico.consulta.index',compact('info'));
        

       
    } */



    public function guardarSignos(Request $request){

        //dd($request);
        $consulta = Consulta::create([
            'cita_id'=>  $request['cita_id'],
            'hce_id'=>  $request['hce'],
            'presion'=>  $request->presion,
            'peso'=>  $request['peso'],
            'temperatura'=>  $request['temperatura'],
            'observacion'=>$request->observacion,
            'talla'=>$request['talla'],
            
        ]);

       
    }

    public function guardarDiagnostico(Request $request){
        //dd($request);
        $consulta= Consulta::findorFail($request->consulta_id);
        $consulta->diagnosticos()->attach($request->input('diagnosticos'));
        $notificacion = 'Diagnosticos asignados correctamente';
        return back()->with(compact('notificacion'));
      
    }

    public function store(Request $request){

    }
}
