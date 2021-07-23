<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        return view('admin.users.index');
    }

    public function create (Request $request){
        
        return view('admin.users.create');
    }

/*     public function store(Request $request)
    {
       // dd($request);
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
    } */

    public function edit( User $user){
        $useru = User::join('people',   'users.persona_id','=','people.id')
        ->where('people.id','=',$user->id)
        ->select('people.*','users.*')
        ->get()->first();
        
        return view('admin.users.edit',compact('useru'));
    }

    public function show($id){

        $user = User::join('people',   'users.persona_id','=','people.id')
        ->where('people.id','=',$id)
        ->select('people.*','users.*')
        ->get()->first();
        //$user=User::where('persona_id',$id)->first();
       return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        
        $reglas=[
            'nombres'=>'required|min:3',
            'apellidos'=>'required|min:3',
            'cedula'=>'nullable|digits:10',
            'telefono'=>'nullable|min:7',
            'genero'=>'required'
        ];


       
        return redirect()->route('admin.users.index');
    }
}
