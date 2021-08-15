<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Antecedentes;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\ConsultaReceta;
use App\Models\DetalleReceta;
use App\Models\Diagnostico;
use App\Models\Medicamento;
use App\Models\Medico;
use App\Models\Paciente;
use PDF;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConsultaController extends Controller
{

    public function edit($id){//cita id

        $info= DB::table('citas')
        ->select('people.nombres as nombres','people.apellidos as apellidos','people.genero as sexo','pacientes.id as paciente_id')
        ->join('pacientes',   'citas.paciente_id','=','pacientes.id')
        ->join('people',   'people.id','=','pacientes.persona_id')
        ->where('citas.id','=',$id)
        ->get()->toArray();

        //llevo el moctivo de la consulta al tab2 del médico
        $citas = DB::table('citas')
        ->join('pacientes','citas.paciente_id','=','pacientes.id')
        ->where('citas.id','=',$id)
        ->select('citas.id as cita_id', 'citas.descripcion as motivo' ,'citas.examen as examen')
        ->get()->first();

        $consulta= Consulta::updateOrCreate(
            [
                'cita_id'=>$id
            ]
        );

        $diagnosticos= Diagnostico::all();

 
     
        $id_diagnosticos = DB::table('diagnosticos')
        ->join('consulta_diagnostico','diagnosticos.id','=','consulta_diagnostico.diagnostico_id')
        ->where('consulta_diagnostico.consulta_id',$consulta->id) 
        ->select('consulta_diagnostico.diagnostico_id as id')
        ->get()->pluck('id'); 

        $medicamentos= Medicamento::all();

        return view('medico.consulta.index' ,compact('citas','consulta','id_diagnosticos','diagnosticos','info','medicamentos'));
    }



    public function guardarDiagnostico(Request $request){
        //dd($request);
        $consulta= Consulta::findorFail($request->consulta_id);
         $consulta->diagnosticos()->attach($request->input('diagnosticos') ,['observacion' => $request->observacion] );
        $notificacion = 'Diagnosticos asignados correctamente';

        return redirect()->back()->with(compact('notificacion'))->withInput(['tab' => 'consulta']);
       
    }

    public function guardarReceta(Request $request){

        //dd($request);
        $dateh = Carbon::now();
        $date = $dateh->format('Y-m-d');

        //CREO LA CONSULTA_RECETE
        $con_rec=ConsultaReceta::create([
            'consulta_id'=>$request->consulta_id,
            'fecha'=>$date,
            'hora'=> $date = Carbon::now()->toDateTimeString()
        ]);
        



        $medicamentos = $request->medicamentos;
        $cantidad = $request->cantidad;
        $indicaciones = $request->indicaciones;
        $consulta_id=$request->consulta_id;

      for($count = 0; $count < count($medicamentos); $count++)
      {
       $data = array(
        'receta_id'=>$con_rec['id'],
        'medicamento_id' => $medicamentos[$count],
        'cantidad'  => $cantidad[$count],
        'indicaciones'=>$indicaciones[$count],
        
       );
       $insert_data[] = $data; 
      } 
        DetalleReceta::insert($insert_data);
        $alerta="Receta Creada Correctamente";

        return redirect()->back()->with(compact('alerta'))->withInput(['tab' => 'tratamiento']);
        
    }

    public function imprimir($id){//consulta_id

        $medicamentos = DB::table('consulta_receta')
        ->join('detalle_receta','consulta_receta.id','detalle_receta.receta_id')
        ->join('medicamentos','detalle_receta.medicamento_id','medicamentos.id')
        ->where('consulta_receta.consulta_id',$id)
        ->get();

        $hora=DB::table('consulta_receta')
        ->join('detalle_receta','consulta_receta.id','detalle_receta.receta_id')
        ->join('medicamentos','detalle_receta.medicamento_id','medicamentos.id')
        ->where('consulta_receta.consulta_id',$id)->select('fecha','hora')->first();

        $infoc=Consulta::findOrFail($id); //toda la informacion de la consulra () $infoc->->consultaReceta //toda la info de la recete y consulta //consultaReceta

        $infoCi=Cita::findOrFail($infoc->cita_id); //toda la informacion de la cita queremos el id paciente para buscra la persona

        $parcienteInfo=Paciente::findOrFail($infoCi->paciente_id);

        $medicoI=Medico::findOrFail($infoCi->medico_id);
       
        $diagnosticos=$infoc->diagnosticos;
     
        $infoPaciente=$parcienteInfo->persona;
        $infoMedico=$medicoI->persona;
       
        //   dd($medicamentos,$infoc->cita_id,$infoCi->paciente_id,$parcienteInfo->persona,$hora);


        $data=compact('medicamentos','infoPaciente','hora','diagnosticos','infoMedico');
        
        $pdf = PDF::loadView('pdf.receta.receta', $data);
        //return $pdf->download('invoice.pdf');

        return $pdf->stream();

        
    }


    public function terminarConsulta(Request $request){

        $cita= Cita::findOrFail($request->cita_id);
        $cita->estado='A';
        $cita->save();
        $notificacion='Cita Atendida';
        return redirect('/citas')->with(compact('notificacion'));
    }
}
