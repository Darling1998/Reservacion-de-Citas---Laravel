<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consulta;

class Diagnostico extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
    ];
    

    protected $table ="diagnosticos"; 

    public function consultas(){
        return $this->belongsToMany(Consulta::class,'diagnostico_id')->withTimestamps();
     }
     
 
}
