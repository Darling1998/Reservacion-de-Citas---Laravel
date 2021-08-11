<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medico;
use App\Models\Cita;

class Especialidad extends Model
{
    use HasFactory;
    protected $table ="especialidads"; 

    protected $fillable=[
        'descripcion',
        'nombre',
    ];

    /*RELACIONES */
    public function medicos(){
        return $this->belongsToMany(Medico::class/* ,'especialidad_medico','especialidad_id' */)->withTimestamps();
     }
     public function citas(){
        return $this->hasMany(Cita::class,'especialidad_id');
    }

}
