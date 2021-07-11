<?php
    namespace App\Interfaces;
    use Carbon\Carbon;

    interface HorarioServicioInterface{

        public function obtenerIntervalosDisponibles($fecha,$id_medico);
        public function disponibilidadIntervalo($date, $medico_id, Carbon $inicio);

    }

?>