<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Antecedentes;
use App\Models\Consulta;
use Illuminate\Support\Facades\DB;

use App\Models\Paciente;
use App\Models\User;
use App\Models\Person;

use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function index(){

        $pacientes = DB::table('pacientes')
        ->join('people','pacientes.persona_id','people.id')
        ->join('users','people.id','=','users.persona_id')->where('pacientes.estado','=','A')->get()->toArray();
         //dd($pacientes); 
        return view('paciente.index',compact('pacientes'));
    }

    public function create(){
        
       
        return view('paciente.create');
    }

    public function store(Request $request){
        $hoy = date('Y-m-d');

      
        
        $request->validate( [
            'nombres'=>'required',
            'apellidos'=>'required',
            'genero'=>'required',
            'fecha_nacimiento'=>'required|date_format:Y-m-d|before_or_equal:'.$hoy,
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
        $edad= $this->calculaedad($request->input('fecha_nacimiento'));
        //dd($edad);
        $persona = Person::create([
            'nombres'=>  $request->nombres,
            'apellidos'=>  $request->apellidos,
            'cedula'=>  $request->cedula,
            'telefono'=> $request->telefono,
            'genero'=>  $request->genero,
            'direccion'=>$request->direccion,
        ]);
 


        $paciente=Paciente::create([
            'persona_id'=>$persona['id'], 
            'fecha_nacimiento'=>$request->input('fecha_nacimiento'),
            'estado_civil'=>$request->est_civil,
            'edad'=>$edad,
        ]);

        $usuario= User::create([
            'persona_id'=>$persona['id'], 
            'email' => $request->email,
            'password' => Hash::make('password'),
        ])->assignRole('paciente');



        $antecedentes= Antecedentes::create([
          'paciente_id'=>$paciente['id']
        ]); 

        

        $paciente->save();

        $antecedentes->save();
       
        return redirect()->route('admin.pacientes.index');


    }

    public function edit($id){//id persona

        //obetenr id paciente 
        $idP= DB::table('pacientes')->where('pacientes.persona_id','=',$id)->select('pacientes.id as paci_id')->first();
    


        //dd($id);
        $paciente = DB::table('pacientes')
        ->join('people',   'pacientes.persona_id','=','people.id')
        ->join('antecedentes','pacientes.id','=','antecedentes.paciente_id')
        ->join('users',   'people.id','=','users.persona_id')->where('pacientes.id','=',$idP->paci_id)
        ->select('people.*', 'pacientes.id as pac_id','pacientes.fecha_nacimiento as fecha_nacimiento','users.email as email','antecedentes.*')
        ->get()->first();

        //dd($id,$paciente,$idP->paci_id);



        
        return view('paciente.edit',compact('paciente'));
    }

    public function guardarAntecedentes(Request $request){

        //$paciente_id=DB::table('pacientes')->where('')
        
        //dd($request);
        Antecedentes::updateOrCreate(
            [
               'paciente_id'=>$request->paciente_id
            ],
            [  
                'antecedentes_personales'=>$request->antecedentes_personales,
                'historia_personal'=>$request->historia_personal,
                'menarquia'=>$request->menarquia,
                'ciclos'=>$request->ciclos,
             /*    'fecha_ultima_menstruacion'=>$request->fecha_ultima_menstruacion, */
                'gestas'=>$request->gestas,
                'cesareas'=>$request->cesareas,
                'abortos'=>$request->abortos,
                'hijos'=>$request->hijos,
                'activo'=>$request->activo,
                'habitos_toxicos'=>$request->habitos_toxicos,
                'examen_funcional'=>$request->examen_funcional,

            ]
         );
            $notificacion ='Antecedentes registrados correctamente';
            return redirect()->route('admin.pacientes.index')->with(compact('notificacion'));
    }

     public function update(Request $request, $id)
    {
        
        $request->validate( [
            'nombres' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'apellidos' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'genero'=>'required',
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
            ],
            'telefono'=>'required'
        ]);

        $person=Person::paciente()->findOrFail($id);
        //dd($request,$person);

        $data = $request->only('nombres','apellidos','cedula','telefono','genero','direccion');
        $person->fill($data);
        $person->save(); // UPDATE

        $notificacion = 'La información del paciente se ha actualizado correctamente.';
    
        return redirect()->route('admin.pacientes.index')->with(compact('notificacion'));
    } 

    public function destroy($id)//persona_id
    {
        // $infoP= DB::table('pacientes')->where('persona_id','=',$id)->select('pacientes.id as pac_id')->first(); //idpaciente

        //dd($infoP->pac_id);

        $us= DB::table('users')->where('users.persona_id','=',$id)->select('users.id as user_id')->first();
        $pac= DB::table('pacientes')->where('pacientes.persona_id','=',$id)->select('pacientes.id as paci_id')->first();
        dd($us->user_id,$pac->paci_id);

        $persona= Person::findOrFail($id);
        $persona->estado='I';
        $persona->save();

        $user=User::findOrFail($us->user_id);
        $user->estado='I';
        $user->save();

        $pacienteId= Paciente::findOrFail($pac->paci_id);
        $pacienteId->estado='I';
        $pacienteId->save();

        $notificacion = "Paciente eliminado Correctamente";
        return redirect('/pacientes')->with(compact('notificacion'));
       
    } 


    public function verMediciones($id){ //idPaciente
    
        $consultas = Consulta::select()->join('citas','consulta.cita_id','citas.id')->where('citas.paciente_id',$id)->get();

        //dd($consultas);
    
        return view('paciente.medicion',compact('consultas'));
    
    
    }


    function calculaedad($fechanacimiento){
        list($ano,$mes,$dia) = explode("-",$fechanacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
          $ano_diferencia--;
        return $ano_diferencia;
      }
}

  