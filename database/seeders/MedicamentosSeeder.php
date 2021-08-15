<?php

namespace Database\Seeders;

use App\Models\Medicamento;
use Illuminate\Database\Seeder;

class MedicamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /*  'nombre'
            ('uso
            'presentacion'
            'laboratorio'
            'estado' */
        $medicamentos = [
            ['descripcion' => 'Abacavir','forma_farmaceutica' => 'Líquido oral','concentracion' => '10 mg/mL','via_administracion' => 'Oral'],
            ['descripcion' => 'Abacavir','forma_farmaceutica' => 'Líquido oral','concentracion' => '20 mg/mL','via_administracion' => 'Oral'],
            ['descripcion' => 'Ácido fólico','forma_farmaceutica' => 'Sólido oral','concentracion' => '5 mg','via_administracion' => 'Oral'],
            ['descripcion' => 'Clotrimazol','forma_farmaceutica' => 'Líquido cutáneo','concentracion' => '1 %','via_administracion' => 'Tópico'],
           /*  ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''],
            ['descripcion' => '','forma_farmaceutica' => '','concentracion' => '','via_administracion' => ''], */
        ];

        foreach($medicamentos as $item){
            Medicamento::create($item);
        }
    }
}
