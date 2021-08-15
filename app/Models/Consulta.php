<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Diagnostico;

class Consulta extends Model
{
    use HasFactory;

    protected $table ="consulta"; 
    protected $fillable=[
        'motivo',
        'peso',
        'presion',
        'talla',
        'temperatura',
        'cita_id',
       
    ];

    public function diagnosticos(){
        return $this->belongsToMany(Diagnostico::class/* ,'especialidad_medico','especialidad_id' */)->withTimestamps();
     }
 
     public function consultaReceta(){
        return $this->hasMany(ConsultaReceta::class,'consulta_id');
    }

    public function cita(){
        return $this->hasOne(Cita::class);
    }
}
