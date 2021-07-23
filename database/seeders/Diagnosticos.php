<?php

namespace Database\Seeders;

use App\Models\Diagnostico;
use Illuminate\Database\Seeder;

class Diagnosticos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diagnosticos = [
            ['codigo' => "A00" , 'descripcion' => 'Cólera'],
            ['codigo' => "A01" ,'descripcion' => 'Fiebres tifoidea y paratifoidea'],
            ['codigo' => "A02", 'descripcion' => 'Otras infecciones debidas a Salmonella'],
            ['codigo' => "A03" ,'descripcion' => 'Shigelosis'],
            ['codigo' => "A04", 'descripcion' => 'Otras infecciones intestinales bacterianas'],
            ['codigo' => "A05",'descripcion' => ' Otras intoxicaciones alimentarias bacterianas, no clasificadas en otra parte'],
           
        ];
        foreach($diagnosticos as $item){
           Diagnostico::create($item);
        }
    }
}
