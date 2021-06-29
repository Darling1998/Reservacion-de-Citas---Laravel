<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $table ="medicos"; 

    protected $fillable = [
        'id',
        'persona_id',
    ];

    /*RELACIONES*/
    public function persona()
    {
        return $this->belongsTo(Person::class, 'foreign_key');
    }

    public function especialidades(){
        return $this->belongsToMany(Especialidad::class)->withTimestamps();
    } 


    /*CONSULTAS */
     public function scopeMedicos($query)
    {
        /*SELECT * FROM medicos m inner join people p on p.id=m.persona_id */
        return $query->join('people',   'people.id','=','medicos.persona_id');
        
    }

}
