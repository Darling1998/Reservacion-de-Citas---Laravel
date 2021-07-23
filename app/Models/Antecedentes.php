<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedentes extends Model
{
    use HasFactory;

    protected $fillable=[
    'antecedentes_personales',
    'historia_personal',
    'menarquia',
    'ciclos',
    'fecha_ultima_menstruacion',
    'gestas',
    'cesareas',
    'abortos',
    'hijos',
    'activo',
    'habitos_toxicos',
    'examen_funcional',
    'paciente_id'
    ];
}
