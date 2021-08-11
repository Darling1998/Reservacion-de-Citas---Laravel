<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cita::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $medicosIds= Medico::doctores()->pluck('id');
        $pacientesIds= Paciente::pacientes()->pluck('id');

        $fecha=$this->faker->dateTimeBetween('2021-01-01','now');
        $fecha_cita= $fecha->format('Y-m-d');
        $hora_cita= $fecha->format('H:i:s');

        $estados=['A','CL'];
        $tipos=['Consulta','Exámen','Operación'];
        
        return [
            'descripcion'=>$this->faker->sentence(5),
            'especialidad_id'=>$this->faker->numberBetween(3,3),
            'medico_id'=>$this->faker->randomElement($medicosIds),
            'fecha_cita'=>$fecha_cita,
            'hora_cita'=>$hora_cita,
            'paciente_id'=>$this->faker->randomElement($pacientesIds),
            'tipo'=>$this->faker->randomElement($tipos),
            'estado'=>$this->faker->randomElement($estados),
        ];
    }
}
