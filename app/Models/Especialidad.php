<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medico;

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
 
}
