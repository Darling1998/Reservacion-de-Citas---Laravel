<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hce extends Model
{
    use HasFactory;
    protected $table ="hce"; 
    protected $fillable=[
        'paciente_id',

    ];
}
