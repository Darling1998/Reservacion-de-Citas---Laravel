<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Paciente;
use App\Models\Consulta;
class Cita extends Model
{
    use HasFactory;

    protected $table ="citas"; 
    protected $fillable=[
        'descripcion',
        'fecha_cita',
        'hora_cita',
        'medico_id',
        'paciente_id',
        'especialidad_id',
        'estado',
        'tipo',
        'examen'
        
    ];
    
    public function medico(){
        return $this->belongsTo(Medico::class);
    }


    public function especialidad(){
        return $this->belongsTo(Especialidad::class);
    }

    public function consulta() {
        return $this->hasOne(Consulta::class);
      }



    //json para fullcalendar
    public function getAllCitas()
    {
        
     /*    SELECT CONCAT(citas.fecha_cita, 'T', citas.hora_cita )as start, citas.descripcion 
     as title FROM citas */
     $citas = Cita::select( DB::raw("CONCAT(citas.fecha_cita, 'T', citas.hora_cita) as start"),DB::raw("CONCAT(people.nombres, ' ', people.apellidos) as title"))
     ->join('pacientes', 'citas.paciente_id', '=', 'pacientes.id')
     ->join('people', 'pacientes.persona_id', '=', 'people.id')
        ->get();
        return $citas;
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class);
    }


}
