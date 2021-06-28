<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table="people";

    protected $fillable = [
        'id',
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'direccion',
    ];

    public function usuario(){
        return $this->hasMany(User::class);
    }

    /* SELECT * FROM people p inner join medicos m on m.persona_id=p.id */

/*    public function scopeMedicos($query){
       return $query->join('medicos','medicos.persona_id','=','people.id');
   } */
}
