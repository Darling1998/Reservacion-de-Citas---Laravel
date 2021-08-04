<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaReceta extends Model
{
    use HasFactory;

    protected $table ="consulta_receta"; 
    protected $fillable=[
        'id',	
        'consulta_id',	
        'cantidad'	
        ,'nombre_medicamento'
        ,'indicaciones'
    ];

    
}
