<?php

namespace Database\Seeders;

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
        $this->call(RolSeeder::class);
       
         $perso1= Person::create([
            'nombres' => 'Darling',
            'apellidos'=> 'De La Cruz',
            'cedula'=> '0928168327',
            'telefono'=> '0986653745',
            'direccion'=> 'Salinas',
        ]);

        $user= User::create([
            'email' => 'delacruzdarjo@hotmail.com',
            'persona_id'=>$perso1['id'], 
            'password' => bcrypt('darling123'),
        ])->assignRole('admin');

    }
}
