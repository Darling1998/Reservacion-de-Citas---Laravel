<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Antecedentes;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Diagnostico;
use Illuminate\Support\Facades\DB;
class ConsultaController extends Controller
{

    public function edit($id){

        $diagnosticos= Diagnostico::all();
       // dd($id);
/*         $paciente = DB::table('pacientes')
        ->join('hce','pacientes.id','=','hce.paciente_id')
        ->join('people',   'pacientes.persona_id','=','people.id')
        ->join('users',   'people.id','=','users.persona_id')->where('people.id','=',$id)
        ->select('people.*', 'pacientes.id as id_medico','pacientes.fecha_nacimiento as fecha_nacimiento','users.email as email','hce.id as num_his')
        ->get()->first();

       // dd($id); */
        return view('medico.consulta.index',compact('diagnosticos'));
    }

/* 
    public function show( $id){

        $info= DB::table('citas')
        ->select('people.nombres as nombres','people.apellidos as apellidos','people.genero as sexo','pacientes.id as paciente_id')
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
        dd($request);
    }
}
