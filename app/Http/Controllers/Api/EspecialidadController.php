<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

use Illuminate\Support\Facades\DB;
class EspecialidadController extends Controller
{
    public function index(){
        return Especialidad::all(['id','nombre']);
    }
   
    public function medicos(Especialidad $especialidad){
        $id_esp=$especialidad->id;

        /* SELECT p.nombres,p.apellidos, esp.* FROM medicos m 
        INNER JOIN especialidad_medico es_me on m.id=es_me.medico_id
        INNER JOIN medicos med on es_me.medico_id=med.id
        INNER join people p on p.id=med.persona_id
        INNER join especialidads esp on es_me.especialidad_id=esp.id
        where esp.id=2 */
        
        $medicos= DB::table('medicos')
        ->join('especialidad_medico','medicos.id','=','especialidad_medico.medico_id')
        ->join('people','people.id','=','medicos.persona_id')
        ->join('especialidads','especialidad_medico.especialidad_id','=','especialidads.id')
        ->where('especialidads.id',$id_esp)->select('medicos.id as id','people.nombres as nombres','people.apellidos as apellidos')
        ->get()->toArray();;

        return $medicos;
        //dd($medicos);

    }
}
