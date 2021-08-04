<?php

namespace App\Http\Controllers\Medico;

use App\Http\Controllers\Controller;
use App\Models\Antecedentes;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\ConsultaReceta;
use App\Models\Diagnostico;
use PDF;
use Illuminate\Support\Facades\DB;
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
        ->join('hce','pacientes.id','=','hce.paciente_id')
        ->where('citas.id','=',$id)
        ->select('citas.id as cita_id','hce.id as hce', 'citas.descripcion as motivo')
        ->get()->first();

        
        //cargo los signos vitales de esa consulta
        $consulta=DB::table('consulta')
        ->where('cita_id','=',$id)
        ->get()->first();;

        //cargarmos el select con CIE-10
        $diagnosticos= Diagnostico::all();

       /*  dd($consulta); */
     
        $id_diagnosticos = DB::table('diagnosticos')
        ->join('consulta_diagnostico','diagnosticos.id','=','consulta_diagnostico.diagnostico_id')
        ->where('consulta_diagnostico.consulta_id',$consulta->id) 
        ->select('consulta_diagnostico.diagnostico_id as id')
        ->get()->pluck('id'); 

        return view('medico.consulta.index' ,compact('citas','consulta','id_diagnosticos','diagnosticos','info'));
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


    public function guardarDiagnostico(Request $request){
        //dd($request);
        $consulta= Consulta::findorFail($request->consulta_id);
         $consulta->diagnosticos()->attach($request->input('diagnosticos') ,['observacion' => $request->observacion] );
        $notificacion = 'Diagnosticos asignados correctamente';
        return back()->with(compact('notificacion'));
      
    }

    public function guardarReceta(Request $request){
        
        $descripcion = $request->descripcion;
        $cantidad = $request->cantidad;
        $indicaciones = $request->indicaciones;
        $consulta_id=$request->consulta_id;
      for($count = 0; $count < count($descripcion); $count++)
      {
       $data = array(
        'consulta_id'=>$consulta_id,
        'nombre_medicamento' => $descripcion[$count],
        'cantidad'  => $cantidad[$count],
        'indicaciones'=>$indicaciones[$count]
       );
       $insert_data[] = $data; 
      } 
        
        ConsultaReceta::insert($insert_data);
        $alerta="Receta Creada Correctamente";
        return back()->with(compact('alerta'));


    }

    public function imprimir($id){
        $medicamentos = DB::table('consulta_receta')
        ->where('consulta_id',$id)
        ->get();
        $data=compact('medicamentos');
        
        $pdf = PDF::loadView('pdf.receta.receta', $data);
        //return $pdf->download('invoice.pdf');

        return $pdf->stream();

        
    }
}
