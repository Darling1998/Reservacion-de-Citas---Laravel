<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Antecedentes;
use App\Models\Hce;
use Illuminate\Support\Facades\DB;

use App\Models\Paciente;
use App\Models\User;
use App\Models\Person;

use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function index(){

        $pacientes = Person::paciente()->get();
        //dd($pacientes);
        return view('paciente.index',compact('pacientes'));
    }

    public function create(){
        
       
        return view('paciente.create');
    }

    public function store(Request $request){

        $persona = Person::create([
            'nombres'=>  $request->nombres,
            'apellidos'=>  $request->apellidos,
            'cedula'=>  $request->cedula,
            'telefono'=> $request->telefono,
             'genero'=>  $request->genero,
             'fecha_nacimiento'=>$request->fecha_nacimiento,
        ]);
 
        $paciente=Paciente::create([
            'persona_id'=>$persona['id'], 
        ]);

        $usuario= User::create([
            'persona_id'=>$persona['id'], 
            'email' => $request->correo,
            'password' => Hash::make('password'),
        ])->assignRole('paciente');

        $hce=Hce::create([
            'paciente_id'=>$paciente['id'],
        ]);

        $hce->save();
        $paciente->save();
        return $usuario;


    }

    public function edit($id){

        $paciente = DB::table('pacientes')
        ->join('hce','pacientes.id','=','hce.paciente_id')
        ->join('people',   'pacientes.persona_id','=','people.id')
        ->join('users',   'people.id','=','users.persona_id')->where('people.id','=',$id)
        ->select('people.*', 'pacientes.id','pacientes.fecha_nacimiento as fecha_nacimiento','users.email as email','hce.id as num_his')
        ->get()->first();

        //dd($id,$paciente);
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
                'antecedentes_personales'=>$request->ante_per,
                'historia_personal'=>$request->historia_personal,
                'menarquia'=>$request->menarquia,
                'ciclos'=>$request->ciclos,
                'fecha_ultima_menstruacion'=>$request->fecha_menstr,
                'gestas'=>$request->gestas,
                'cesareas'=>$request->numCesa,
                'abortos'=>$request->numAbortos,
                'hijos'=>$request->numHijos,
                'activo'=>$request->activo,
                'habitos_toxicos'=>$request->habiPsicobiologicos,
                'examen_funcional'=>$request->habiPsicobiologicos,

            ]
         );
         $notificacion ='Registro guardado correctamente';
            return back()->with(compact('notificacion'));
    }

    public function update(Request $request, $id)
    {
        
        $reglas=[
            'nombres'=>'required|min:3',
            'apellidos'=>'required|min:3',
            'cedula'=>'nullable|digits:10',
            'telefono'=>'nullable|min:7',
        ];


        $this->validate($request,$reglas);
        $paciente=Paciente::where('persona_id',$id)->first();
       //dd($request,$paciente);

        
        $data = $request->only('nombres','apellidos','cedula','telefono','email');
      
        
        $paciente->fill($data);
        $paciente->save(); 
        $paciente->especialidades()->sync($request->input('especialidades'));
        
        $notificacion = 'La información del médico se ha actualizado correctamente.';
    
        return redirect()->route('admin.medicos.index')->with(compact('notificacion'));
    }

}
