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
        'fecha',
        'hora',
    ];

    public function consulta(){
        return $this->belongsTo(Consulta::class,'recete_id');
    }

    public function detalleR(){
        return $this->hasMany(DetalleReceta::class,'receta_id');
    }


}
