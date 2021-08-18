<?php

namespace App\Http\Controllers\Asistente;

use App\Http\Controllers\Controller;
use App\Interfaces\HorarioServicioInterface;
use App\Mail\ReservadaMailable;
use App\Models\Antecedentes;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Hce;
use App\Models\Paciente;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ReservaController extends Controller
{
   public function index(HorarioServicioInterface $horarioServ){
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

    return view('asistente.reserva.index',compact('especialidades','medicos','intervalos'));
   }

   public function store(Request $request,HorarioServicioInterface $horaI){

        $user = Person::where('cedula', '=', $request->cedula)->first();
        $hoy = date('Y-m-d');
      

        $infoG=DB::table('people');
      
        if ($user === null) {
            $paciente_id='';
            $email_pac='';
            $nombre_pac='';

            $request->validate( [
                'nombres' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
                'apellidos' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                
                'cedula'=>[
                    'unique:people',
                    function ($attribute, $value, $fail) {
                        $num1 = substr($value,0,1);
                        $num2 = substr($value,1,1);
                        $num3 = substr($value,2,1);
                        $num4 = substr($value,3,1);
                        $num5 = substr($value,4,1);
                        $num6 = substr($value,5,1);
                        $num7 = substr($value,6,1);
                        $num8 = substr($value,7,1);
                        $num9 = substr($value,8,1);
                        $num10 = substr($value,9,1);
                        $pares = $num2 + $num4 + $num6 + $num8;
                        // echo $pares;
                        if(strlen($value) == 10){
                            if(substr($value,0,2) >= 01 && substr($value,0,2) <= 24){
                                $num1 = $num1 * 2;
                                if(($num1) > 9){$num1 = $num1 - 9;}
                                $num3 = $num3 * 2;
                                if($num3 > 9){$num3 = $num3 - 9;}
                                $num5 = $num5 * 2;
                                if($num5 > 9){$num5 = $num5 - 9;}
                                $num7 = $num7 * 2;
                                if($num7 > 9){$num7 = $num7 - 9;}
                                $num9 = $num9 * 2;
                                if($num9 > 9){$num9 = $num9 - 9;}
                                $impares = $num1 + $num3 + $num5 + $num7 + $num9;
                                $total = $pares + $impares;
                                $mod = $total % 10;
                                $numero_validador = 10 - $mod;
                                // echo $numero_validador;
                                if($numero_validador == 10){
                                    $numero_validador = 0;
                                }
                                if($numero_validador == $num10){
                                return ;
                                }else{
                                    $fail('La '.$attribute.' es invalida');
                                    //exit;
                                }
                            }else{
                                $fail('La '.$attribute.' es invalida');
                                //exit;
                            }
    
                        }else{
                            $fail('La '.$attribute.' es invalida');
                        }
                    }
                ]
            ]);
            
            $persona = Person::create([
                'nombres'=>  $request['nombres'],
                'apellidos'=>  $request['apellidos'],
                'cedula'=>  $request['cedula'],
                'telefono'=>  $request['telefono'],
            ]);
     

            $persona->save();

            $paciente=Paciente::create([
                'persona_id'=>$persona['id'], 
            ]);
           

            $usuario= User::create([
                'persona_id'=>$persona['id'], 
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ])->assignRole('paciente');;
    
            $email_pac=$usuario['email'];


            $paciente_id=$paciente['id'];

            $antecedentes= Antecedentes::create([
                'paciente_id'=>$paciente['id']
            ]); 

            $paciente->save();
         
            $antecedentes->save(); 

            $nombre_pac=$persona['nombres'];
            $reglas=[
                'fecha_cita'=>'date_format:Y-m-d|after_or_equal:'.$hoy,
                'hora_cita'=>'required',
                'medico_id'=>'exists:medicos,id',
                'especialidad_id'=>'exists:especialidads,id',
               
            ];
    
            $mensajes=[
                'hora_cita.required'=>'Selecciona una hora válida para su cita',
               'fecha_cita.after_or_equal'=>'Ingrese una fecha válida'
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
    
            //preparo la data
            $data= $request->only([
                'fecha_cita',
                'hora_cita',
                'medico_id',
                'paciente_id',
                'especialidad_id',
            ]);
            $data['paciente_id']=$paciente_id;
            $carbonTime= Carbon::createFromFormat('g:i A',$data['hora_cita']);
            $data['hora_cita']=$carbonTime->format('H:i:s');
    
            $cita= Cita::create($data);
            $medico_id=$request->input('medico_id');
            
            $infomedico=DB::table('medicos')
                ->join('people',   'medicos.persona_id','=','people.id')
                ->where('medicos.id','=',$medico_id)
                ->select(DB::raw("CONCAT(people.nombres,' ',people.apellidos) as nombre_medico"))
                ->get()->first();
      
            $infoEsp=DB::table('especialidads')
                ->where('especialidads.id','=',$request->input('especialidad_id'))
                ->select('especialidads.nombre as especialidad')
                ->get()->first();
    
    
    
            $infoCita =[];
            $infoCita['id']=$cita['id'];
            $infoCita['medico']=$infomedico->nombre_medico;
            $infoCita['especialidad']=$infoEsp->especialidad;
            $infoCita['paciente']=$nombre_pac;
            $infoCita['fecha']=$request->input('fecha_cita'); 
            $infoCita['hora']=$request->input('hora_cita');
    
            //dd($infoCita);
            $correo = new ReservadaMailable($infoCita);
            Mail::to($email_pac)->send($correo);
    

        }else{

            $reglas=[
                'fecha_cita'=>'date_format:Y-m-d|after_or_equal:'.$hoy,
                'hora_cita'=>'required',
                'medico_id'=>'exists:medicos,id',
                'especialidad_id'=>'exists:especialidads,id',
               
            ];
    
            $mensajes=[
                'hora_cita.required'=>'Selecciona una hora válida para su cita',
                'fecha_cita.after_or_equal'=>'Ingrese una fecha válida'
               
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
    
            //preparo la data
            $data= $request->only([
                'fecha_cita',
                'hora_cita',
                'medico_id',
                'paciente_id',
                'especialidad_id',
            ]);

            $res= DB::table('pacientes')
            ->join('people',   'pacientes.persona_id','=','people.id')
            ->join('users','people.id','=','users.persona_id')
            ->where('people.id','=',$user->id)
            ->select(DB::raw("CONCAT(people.nombres,' ',people.apellidos) as nombre_paciente"),'pacientes.id as paciente_id','users.email as email')
            ->get()->first();
    
            $id_pa = json_decode($res->paciente_id);

            //seteando la data
            $data['paciente_id']=$id_pa;
            $carbonTime= Carbon::createFromFormat('g:i A',$data['hora_cita']);
            $data['hora_cita']=$carbonTime->format('H:i:s');
            
            $cita= Cita::create($data);
    
            //******************ENVIAR EMAIL DE RESERVA CORRECTA***********************///
            $medico_id=$request->input('medico_id');
            
            $infomedico=DB::table('medicos')
                ->join('people',   'medicos.persona_id','=','people.id')
                ->where('medicos.id','=',$medico_id)
                ->select(DB::raw("CONCAT(people.nombres,' ',people.apellidos) as nombre_medico"))
                ->get()->first();
      
            $infoEsp=DB::table('especialidads')
                ->where('especialidads.id','=',$request->input('especialidad_id'))
                ->select('especialidads.nombre as especialidad')
                ->get()->first();
    
            $infoCita =[];
            $infoCita['id']=$cita['id'];
            $infoCita['medico']=$infomedico->nombre_medico;
            $infoCita['especialidad']=$infoEsp->especialidad;
            $infoCita['paciente']=$res->nombre_paciente;
            $infoCita['fecha']=$request->input('fecha_cita'); 
            $infoCita['hora']=$request->input('hora_cita');
    
            //dd($infoCita);
            $correo = new ReservadaMailable($infoCita);
            Mail::to($res->email)->send($correo);
    
    
        }

        $notificacion="La cita se ha registrado correctamente";
        return back()->with(compact('notificacion'));

   }


   public function search(Request $request) {
        $mensaje  ="Error interno de la aplicación";
        $validar = false;
        $cedula = $request->input('cedula');
        if(empty($cedula)){
            $mensaje ="Por favor ingresa la identificación";
        }else{
            
            $paciente = DB::table('people')->join('users','people.id','users.persona_id')->where('cedula', '=', $cedula)->first();
            $mensaje = "";
            $validar = true;

            //return response()->json($paciente);
            return response()->json([
                'paciente'=>$paciente,
                'mensaje' => $mensaje,
                'validar' => $validar,
            ]);
        }
        return response()->json([
            'mensaje' => $mensaje,
            'validar' => $validar,
        ]);
    }
}
