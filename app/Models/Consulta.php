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
        'observacion',
        'peso',
        'presion',
        'talla',
        'temperatura',
        'cita_id',
        'hce_id',
    ];

    public function diagnosticos(){
        return $this->belongsToMany(Diagnostico::class/* ,'especialidad_medico','especialidad_id' */)->withTimestamps();
     }
 
}
