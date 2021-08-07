<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class Paciente extends Model
{
    use HasFactory;
    protected $table ="pacientes";
    
    protected $fillable=[
        'persona_id',
        'fecha_nacimiento'
    ];

    public function persona(){
        return $this->belongsTo(Person::class);
    }

    public function scopePacientes($query)
    {
        $users = User::role('paciente')->get();
    }
}
