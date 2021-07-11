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
    protected $hidden = [
        'created_at',
        'updated_at'
       
    ];


    public function usuario(){
        return $this->hasMany(User::class);
    }

    public function medicos(){
        return $this->hasMany(User::class);
    }


    
    /* SELECT * FROM people p inner join medicos m on m.persona_id=p.id INNER JOIN users u on p.id=u.persona_id */
    public function scopeDoctores($query){
       return $query->join('medicos','medicos.persona_id','=','people.id')
       ->join('users','people.id','=','users.persona_id');
   } 
}
