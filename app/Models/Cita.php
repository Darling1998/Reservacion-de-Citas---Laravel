<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable=[
        'descripcion',
        'fecha_cita',
        'hora_cita',
        'medico_id',
        'paciente_id',
        'especialidad_id',
        'estado',
    ];

}
