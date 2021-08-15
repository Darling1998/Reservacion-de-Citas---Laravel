<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotificacionMailable;
use App\Mail\NotificacionMMailable;
use App\Models\Cita;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;
use App\Models\Medico;
use App\Models\Especialidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    /*     protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres'=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
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
    } */
   
    public function index()
    {
        $medicos = Person::doctores()->get();
        return view('admin.medicos.index',compact('medicos'));
    }


    public function create(Request $request)
    {
        $especialidades = Especialidad::all();
        return view('admin.medicos.create',compact('especialidades'));
    }



    public function store(Request $request)
    {
       // dd($request);

        $request->validate( [
            'nombres' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'apellidos' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'password' => ['required', 'string', 'min:8'],
            'especialidades'=>'required',
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
            'direccion'=>  $request['direccion'],
            'genero'=>$request['genero'],
        ]);
 
        $user= User::create([
            'persona_id'=>$persona['id'], 
            'email' => $request['email'],
            'password' =>bcrypt($request->input('password')),
        ])->assignRole('doctor');

        $medico=Medico::create([
            'persona_id'=>$persona['id'], 
        ]);

        $user->save();
        $medico->save();
       
        $medico->especialidades()->attach($request->input('especialidades'));
        $notificacion = 'El médico se ha registrado correctamente.';
        return redirect()->route('admin.medicos.index')->with(compact('notificacion'));
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        
        $medico = DB::table('medicos')
            ->join('people',   'medicos.persona_id','=','people.id')
            ->join('users',   'people.id','=','users.persona_id')->where('people.id','=',$id)
            ->select('people.*', 'medicos.id as id_medico')
            ->get()->first();
    
        $especialidades = Especialidad::all();
       
        $id_especialidades = DB::table('especialidads')
                ->join('especialidad_medico','especialidads.id','=','especialidad_medico.especialidad_id')
                ->where('especialidad_medico.medico_id',$medico->id_medico)
                ->select('especialidad_medico.especialidad_id as id')
                ->get()->pluck('id');

              //  dd($id_especialidades);
        $notificacion = 'El médico se ha registrado correctamente.';
        
        return view('admin.medicos.edit' ,compact('medico','especialidades','id_especialidades'));
    }

    
    public function update(Request $request, $id)
    {
        
        $reglas=[
            'nombres' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'apellidos' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
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
            ],
            'telefono'=>'nullable|min:7',
        
        ];


        $this->validate($request,$reglas);
        $medico=Medico::where('persona_id',$id)->first();
       //dd($request,$medico);

        
        $data = $request->only('nombres','apellidos','cedula','telefono','email','direccion');
      
        
        $medico->fill($data);
        $medico->save(); 
        $medico->especialidades()->sync($request->input('especialidades'));
        
        $notificacion = 'La información del médico se ha actualizado correctamente.';
    
        return redirect()->route('admin.medicos.index')->with(compact('notificacion'));
    }

    
    public function destroy($id)//persona_id
    {
       $infoM= DB::table('medicos')->where('persona_id','=',$id)->select('medicos.id')->first();

       $citas= DB::table('citas')
       ->join('pacientes','citas.paciente_id','pacientes.id')
       ->join('people','pacientes.persona_id','people.id')
       ->join('users','people.id','users.persona_id')
       ->where('medico_id','=',$infoM->id)->select('users.email','citas.hora_cita','citas.fecha_cita')
       ->get();

       $us= DB::table('users')->where('users.persona_id','=',$id)->select('users.id as user_id')->first();
       $med= DB::table('medicos')->where('medicos.persona_id','=',$id)->select('medicos.id as med_id')->first();
      // dd($us->user_id);

       $persona= Person::findOrFail($id);
       $persona->estado='I';
       $persona->save();

       $user=User::findOrFail($us->user_id);
       $user->estado='I';
       $user->save();

       $medicoI= Medico::findOrFail($med->med_id);
       $medicoI->estado='I';
       $medicoI->save();

       //dd($citas);
    /*        $correos= DB::table('users')
       ->join('people','users.persona_id','people.id')
       ->join('pacientes','people.id','pacientes.persona_id')
       ->select('email')->get();
        */
        Cita::where('medico_id', $infoM->id)->update(['estado' => 'CL']);

        foreach ($citas as $item) {
            $correo = new NotificacionMMailable($item->hora_cita, $item->fecha_cita);
            Mail::to($item->email)->send($correo);
        }


        $notificacion = "Medico eliminado Correctamente";

       } 

      

       //dd($citas);

    
    
}
