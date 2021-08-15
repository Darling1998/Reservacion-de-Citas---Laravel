<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Person;
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

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'nombres' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'apellidos' => ['required', 'string', 'max:100','regex:/^[a-zA-Z\s]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'genero'=>['required'],
            'role'=>['required'],
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
                        //exit;
                    }
                }
          
            ]
        ]);
       
   //dd($request);
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
        ])->assignRole($request['role']);


        $user->save();

        $notificacion = 'Usuario registrado correctamente.';
        return redirect()->route('admin.users.index')->with(compact('notificacion')); 
    }

    public function edit( User $user){


        $useru = User::join('people',   'users.persona_id','=','people.id')
        ->where('people.id','=',$user->id)
        ->select('people.*','users.*')
        ->get()->first();
        
        return view('admin.users.edit',compact('useru','user'));
    }

    public function show($id){

        $user = User::join('people',   'users.persona_id','=','people.id')
        ->where('people.id','=',$id)
        ->select('people.*','users.*')
        ->get()->first();
        //$user=User::where('persona_id',$id)->first();
       return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id)//user_id
    {
      
        $user= User::findOrFail($id);
       
        $user->update($request->except('role','password'));

        $p= DB::table('people')->join('users','people.id','users.persona_id')->where('users.id','=',$id)->select('users.persona_id')->first();
        $persona= Person::findOrFail($p->persona_id);
        
        $data = $request->only('nombres','apellidos','cedula','telefono','estado');
      
        
        $persona->fill($data);
        $persona->save(); 

        /*  $request->validate( [
                'nombres'=>'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => [ 'string', 'min:8'],
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
                'genero'=>'required',
                'estado'=>'required'
            ]);*/


        if ($request->has('role'))
        {
            $user->syncRoles($request->role);
        }

       
        return redirect()->route('admin.users.index');
    }
}
