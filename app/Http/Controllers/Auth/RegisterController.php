<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Person;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
 

    use RegistersUsers;

   
    protected $redirectTo = RouteServiceProvider::HOME;

    
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
    }

    
    protected function create(array $data)
    {
        $persona = Person::create([
            'nombres'=>  $data['nombres'],
            'apellidos'=>  $data['apellidos'],
            'cedula'=>  $data['cedula'],
            'telefono'=>  $data['telefono'],
            'direccion'=>  $data['direccion'],
        ]);
 
        $usuario= User::create([
             'persona_id'=>$persona['id'], 
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole('paciente');;

        return $usuario;

    }
}
