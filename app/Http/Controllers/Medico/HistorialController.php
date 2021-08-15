<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class HistorialController extends Controller
{
    public function index(){
        $historia= DB::table('pacientes')
        ->join('people','pacientes.persona_id','people.id')
        ->join('citas','pacientes.id','citas.paciente_id')
        ->select('people.*', 'pacientes.id as pac_id')
        ->get();

        //dd($historia);
/*         select p.*, pac.id as pac_id, c.descripcion from pacientes pac 
        INNER JOIN people p on pac.persona_id=p.id
        inner join citas c on pac.id=c.paciente_id */
        return view('medico.historial.index',compact('historia'));
    }


    public function verHistoria(Request $request){//traugo el id del pacinete y la cedula

        $paciente= Paciente::findOrFail($request->pac_id);

        $antecedentes=$paciente->antecedentes;
      

       //diangosticos por consulta
       $consultas= $historia= DB::table('consulta')
       ->select('consulta.*','consulta.motivo','people.nombres as nombres','people.apellidos as apellidos')
        ->join('citas','consulta.cita_id','citas.id')
        ->join('medicos','citas.medico_id','medicos.id')
        ->join('people','medicos.persona_id','people.id')
        ->where('citas.paciente_id','=',$request->pac_id)
        ->get();


        $infoPaciente=$paciente->persona->nombres;
        
       //dd($consultas,$paciente);
       $data=compact('antecedentes','paciente','consultas');
      
        PDF::setOptions([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'fontHeightRatio' => 1,
            'isPhpEnabled' => true,
        ]);
        $pdf = PDF::loadView('pdf.historial.index',$data);
        //return $pdf->download('invoice.pdf');

        return $pdf->stream();


    }
}
