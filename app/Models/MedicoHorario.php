<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoHorario extends Model
{
    use HasFactory;
    protected $fillable = [
        'dia',
        'activo',
        'hora_inicio_mñn',
        'hora_fin_mñn',
        'hora_inicio_tarde',
        'hora_fin_tarde',
        'medico_id'
    ];
    protected $table ="medico_horarios"; 

/*     public function medicos(){
        return $this->belongsTo(Medico::class,'medico_id');
    } */

}
