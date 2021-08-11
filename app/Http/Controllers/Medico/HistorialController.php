<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HistorialController extends Controller
{
    public function index(){
        $historia= DB::table('pacientes')
        ->join('people','pacientes.persona_id','people.id')
        ->join('citas','pacientes.id','citas.paciente_id')
        ->select('people.*', 'pacientes.id as pac_id','citas.descripcion as motivo','citas.fecha_cita as fecha','citas.id as cita_id')
        ->get();

        //dd($historia);
/*         select p.*, pac.id as pac_id, c.descripcion from pacientes pac 
        INNER JOIN people p on pac.persona_id=p.id
        inner join citas c on pac.id=c.paciente_id */
        return view('medico.historial.index',compact('historia'));
    }


    public function verHistoria(Request $request){
        //;
        //dd($request);
        $historia= DB::table('pacientes')
        ->join('people','pacientes.persona_id','people.id')
        ->join('hce','pacientes.id','hce.paciente_id')
        ->join('consulta','hce.id','consulta.hce_id')
        ->join('consulta_diagnostico','consulta.id','consulta_diagnostico.consulta_id')
        ->join('citas','pacientes.id','citas.paciente_id')
        /* ->where('people.cedula','=',$request->cedula)
        ->where('consulta.cita_id','=',$request->cita_id) */
        ->select('people.*')
        ->get();

        $infoPaciente= DB::table('people')->where('cedula',$request->cedula)->first();//nombres-cabecera
        $diag = DB::table('consulta')->where('cita_id',$request->cita_id)->first(); //signos vitales

        $consult= DB::table('consulta')
            ->join('citas','consulta.cita_id','citas.id')
            ->where('consulta.cita_id',$request->cita_id)
            ->select('citas.descripcion as motivo','consulta.created_at as fecha')
            ->first();

        $infoC= DB::table('citas')
        ->join('medicos','citas.medico_id','medicos.id')
        ->join('people','medicos.persona_id','people.id')->where('citas.id',$request->cita_id)->select('people.nombres', 'people.apellidos')->first();
        //dd($consult);
        $diagnosticos= DB::table('consulta_diagnostico')->join('diagnosticos','consulta_diagnostico.diagnostico_id','diagnosticos.id')->select('diagnosticos.descripcion','diagnosticos.codigo')->where('consulta_id','=', $diag->id)->get();
        //dd($infoPaciente,$diag,$diagnosticos);



        //dd($historia);
        /*         select p.*, pac.id as pac_id, c.*, cd.* from pacientes pac 
        INNER JOIN people p on pac.persona_id=p.id
        INNER JOIN hce hc on pac.id=hc.paciente_id
        INNER join consulta c on hc.id=c.hce_id
        inner join consulta_diagnostico cd on c.id=cd.consulta_id
        where p.cedula='2450267394' AND where consulta.cita_id=$reuquest->cita */

  
        $data=compact('infoPaciente','diag','diagnosticos','consult','infoC');
        
        $pdf = PDF::loadView('pdf.historial.index', $data);
        //return $pdf->download('invoice.pdf');

        return $pdf->stream();


    }
}
