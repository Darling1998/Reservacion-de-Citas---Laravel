<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table ="pacientes";
    
    protected $fillable=[
        'persona_id',
    ];

    public function persona(){
        return $this->belongsTo(People::class);
    }

}
