<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServicioInterface;
use App\Models\Cita;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
{
    public function index(){
        $per_medi=auth()->user()->id;

        if (auth()->user()->hasRole('admin')) {
            $citasPendientes = Cita::where('estado','R')->paginate(10);
            $citasConfirmadas = Cita::where('estado','C')->paginate(10);
            $citasViejas= Cita::whereIn('estado',['C','A'])->orderby('fecha_cita','DESC')->paginate(10);

        }elseif (auth()->user()->hasRole('doctor')){
            
            $user = DB::table('medicos')
                ->join('people', 'medicos.persona_id', '=', 'people.id')
                ->where('people.id', '=', $per_medi)
                ->select('medicos.id as id_medico')
                ->first();
            $citasPendientes = Cita::where('estado','R')->where('medico_id',$user->id_medico)->paginate(1);
            $citasConfirmadas = Cita::where('estado','C')->where('medico_id',$user->id_medico)->paginate(1);
            $citasViejas= Cita::whereIn('estado',['Cancelada','A'])->where('medico_id',$user->id_medico)->paginate(1);

        } elseif (auth()->user()->hasRole('paciente')){
            $user = DB::table('pacientes')
            ->join('people', 'pacientes.persona_id', '=', 'people.id')
            ->where('people.id', '=', $per_medi)
            ->select('pacientes.id as id_paciente')
            ->first();

            $citasPendientes = Cita::where('estado','R')->where('paciente_id',$user->id_paciente)->paginate(1);
            $citasConfirmadas = Cita::where('estado','C')->where('paciente_id',$user->id_paciente)->paginate(1);
            $citasViejas= Cita::whereIn('estado',['C','A'])->where('paciente_id',$user->id_paciente)->paginate(1);

        } 

       // dd($citasConfirmadas,$citasPendientes,$citasViejas);
        return view('citas.index',compact('citasConfirmadas','citasPendientes','citasViejas'));
    }


    public function create(HorarioServicioInterface $horarioServ)
    {
        $especialidades=Especialidad::all();

        $especialidadId=old('especialidad_id');

        if($especialidadId){
            $especialidad= Especialidad::find($especialidadId);
            $medicos=$especialidad->medicos;

        }else{
            $medicos= collect();
        }

        $fechaProg = old('fecha_cita');
        $medicoId=old('medico_id');

        if($fechaProg && $medicoId){
            //dd($medicos);
            $intervalos=$horarioServ->obtenerIntervalosDisponibles($fechaProg,$medicoId);
        }else{
            $intervalos=null;
        }
        return view('paciente.cita.create',compact('especialidades','medicos','intervalos'));
    }
    
    public function store(Request $request,HorarioServicioInterface $horaI){

        $id_ses_paci= auth()->id();

        $reglas=[
            'descripcion'=>'required',
            'hora_cita'=>'required',
            'medico_id'=>'exists:medicos,id',
            'especialidad_id'=>'exists:especialidads,id',
        ];

        $mensajes=[
            'hora_cita.required'=>'Selecciona una hora válida para su cita'
        ];
        
        $validator=Validator::make($request->all(),$reglas,$mensajes);

        $validator->after(function($validator) use ($request,$horaI){
            $fecha=$request->input('fecha_cita');
            $medico_id=$request->input('medico_id');
            $horaC=$request->input('hora_cita');

            if($fecha && $medico_id && $horaC){
                $inicio= new Carbon($horaC);
            }else{
                return;
            }

            if(!$horaI->disponibilidadIntervalo($fecha,$medico_id,$inicio)){
                $validator->errors()
                    ->add('disponibilidad','La hora seleccionada ya se encuentra ocupada.');
            }
        });

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

    /*     select p.id as paciente_id FROM pacientes p 
        inner join people pe on p.persona_id=pe.id
         WHERE pe.id=3 */

        $res= DB::table('pacientes')
        ->join('people',   'pacientes.persona_id','=','people.id')
        ->where('people.id','=',$id_ses_paci)
        ->select('pacientes.id as paciente_id')
        ->get()->first();

        $id_pa = json_decode($res->paciente_id);
  
        $data= $request->only([
            'descripcion',
            'fecha_cita',
            'hora_cita',
            'medico_id',
            'paciente_id',
            'especialidad_id',
            'estado',
        ]);

        $data['paciente_id']=$id_pa;
        $carbonTime= Carbon::createFromFormat('g:i A',$data['hora_cita']);
        $data['hora_cita']=$carbonTime->format('H:i:s');
        Cita::create($data);


        $notificacion="La cita se ha registrado correctamente";
        return back()->with(compact('notificacion'));

    }

    public function postConfirmar(Cita $cita){

    
        $cita->estado='C';
        
        $guardado = $cita->save();
      
 
        $notificacion='La cita se ha confirmado correctamente';
      
        return redirect('/citas')->with(compact('notificacion'));
    }
 
}
