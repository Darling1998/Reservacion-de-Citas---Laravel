<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Person;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                 RolSeeder::class, 
                Diagnosticos::class,
                MedicamentosSeeder::class,

            ]
        );
       

        $especialidad1=Especialidad::create([
            'nombre'=>'Cardiologia',
            'descripcion'=>'Detectamos enfermedades al corazón'
        ]);

        $especialidad2=Especialidad::create([
            'nombre'=>'Pediatría',
            'descripcion'=>'Especialidad médica que estudia al niño y sus enfermedades'
        ]);

         $perso1= Person::create([
            'nombres' => 'Darling',
            'apellidos'=> 'De La Cruz',
            'cedula'=> '0928168327',
            'telefono'=> '0986653745',
            'direccion'=> 'Salinas',
            'Genero'=>'M'
        ]);

        $user= User::create([
            'email' => 'delacruzdarjo@hotmail.com',
            'persona_id'=>$perso1['id'], 
            'password' => bcrypt('password'),
        ])->assignRole('admin');


        $perso2= Person::create([
            'nombres' => 'Jessica',
            'apellidos'=> 'Pluas',
            'cedula'=> '0915919195',
            'telefono'=> '0785632',
            'direccion'=> 'Salinas',
            'Genero'=>'F'
        ]);

        $user2= User::create([
            'email' => 'jessica123@hotmail.com',
            'persona_id'=>$perso2['id'], 
            'password' => bcrypt('password'),
        ])->assignRole('asistente');


    }
}
