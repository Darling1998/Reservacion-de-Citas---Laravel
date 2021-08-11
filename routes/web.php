<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\MedicoController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Asistente\SignosController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\Medico\ConsultaController;
use App\Mail\ReservadaMailable;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();


Route::get('logout' ,[App\Http\Controllers\HomeController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin' ])->group(function () {
    Route::resource('users', UserController::class)->names('admin.users');
    Route::resource('roles', RolController::class)->names('admin.roles');
    Route::resource('especialidades', EspecialidadController::class)->names('admin.especialidades');
    Route::resource('medicos', MedicoController::class)->names('admin.medicos');
   
    Route::post('correo/comunicar', [App\Http\Controllers\HomeController::class, 'notificar'])->name('admin.notificar'); 
    /* Route::get('/reportes/citas/lineas',[App\Http\Controllers\Admin\ReporteController::class, 'reporteBarras'])->name('admin.reportes.barra'); */
    Route::get('reportes',[App\Http\Controllers\Admin\ReporteController::class, 'index'])->name('admin.reportes');

    Route::get('agenda',[App\Http\Controllers\AgendaController::class, 'index'])->name('agenda.index');
    Route::get('agenda/mostrar',[App\Http\Controllers\AgendaController::class, 'show']);
});


Route::middleware(['auth', 'asistente'])->group(function () {
    Route::post('pacientes/antecedentes', [App\Http\Controllers\Admin\PacienteController::class,'guardarAntecedentes'])->name('asistente.guardarAntecedentes');
    Route::post('signos', [App\Http\Controllers\Asistente\SignosController::class, 'guardarSignos'])->name('asistente.guardarSignos');
});

//medicos
Route::middleware(['auth'  ,'doctor'])->group(function () {
    Route::get('horarios',[App\Http\Controllers\Medico\HorarioController::class, 'edit'])->name('medicos.horarios.edit');
    Route::post('horarios',[App\Http\Controllers\Medico\HorarioController::class, 'store'])->name('medicos.horarios.store');
   
    Route::post('consulta/diagnostico', [App\Http\Controllers\Medico\ConsultaController::class,'guardarDiagnostico'])->name('medico.guardarDiagnostico');
    Route::post('consulta/receta', [App\Http\Controllers\Medico\ConsultaController::class,'guardarReceta'])->name('medico.guardarReceta');
    Route::post('consulta/terminar',[App\Http\Controllers\Medico\ConsultaController::class,'terminarConsulta'])->name('medico.terminarConsulta');
    Route::post('/reserva/{cita}/confirmar', [App\Http\Controllers\CitaController::class, 'postConfirmar'])->name('medico.comfirmarCita'); 
    Route::resource('consulta', ConsultaController::class)->names('medicos.citas');

    Route::get('/historia-clinico',[App\Http\Controllers\Medico\HistorialController::class,'index'])->name('medico.historial');
    Route::post('/historia-pdf',[App\Http\Controllers\Medico\HistorialController::class,'verHistoria'])->name('medico.historial.generate');
    Route::get('receta/imprimir/{id}' ,[App\Http\Controllers\Medico\ConsultaController::class,'imprimir'])->name('medico.consulta.receta');
});
 
//Guardar Antecedentes
 /* Route::post('antecedentes', [App\Http\Controllers\Medico\ConsultaController::class,]); */
  Route::post('consulta/signos', [App\Http\Controllers\Medico\ConsultaController::class,'guardarSignos']); 

  
  /* Route::post('correo/comunicar', [App\Http\Controllers\Admin\DashboardController::class,'notificar']);  */
  

 ///para reservar DE LADO DE PACIENTE
Route::middleware(['auth' ,'paciente'])->group(function () {
    Route::get('reserva/create',[App\Http\Controllers\CitaController::class, 'create']) ->name('pacientes.reserva.index') ;
    Route::post('reserva',[App\Http\Controllers\CitaController::class, 'store'])->name('pacientes.reserva.create');
});


Route::middleware(['auth', 'asistente','admin'])->group(function () {
   
});

Route::resource('pacientes', PacienteController::class)->names('admin.pacientes');
Route::get('citas',[App\Http\Controllers\CitaController::class, 'index'])->name('citas.listar');
//JSON
Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);



 Route::put('/pacientes/{paciente}',[App\Http\Controllers\Admin\PacienteController::class, 'update']); //actualiza un paciente

Route::middleware(['auth', 'asistente'])->group(function () {
    Route::get('signos/consulta/{id}/create', [App\Http\Controllers\Asistente\SignosController::class,'create'])->name('medico.consulta.create');
    Route::get('asistente/reservar',[App\Http\Controllers\Asistente\ReservaController::class,'index'])->name('asistente.reserva.create');
    Route::post('asistente/reservar/guardar',[App\Http\Controllers\Asistente\ReservaController::class,'store'])->name('asistente.reserva.store');
});

///REPORTES
Route::get('/reportes/medicos/barras/infor',[App\Http\Controllers\Admin\ReporteController::class, 'medicosJson']);

Route::get('/reportes/especialidades/torta',[App\Http\Controllers\Admin\ReporteController::class, 'especialidadesDemandadas']);
Route::get('/reportes/especialidades/torta/infor',[App\Http\Controllers\Admin\ReporteController::class, 'especialidadesDemandadasJson']);

/* Route::get('/reportes/hola',[App\Http\Controllers\Admin\ReporteController::class, 'hola']); */

/* Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']); */

Route::get('/antecedentes',[App\Http\Controllers\Admin\PacienteController::class,'llenarAntecedentes']);




//reservar del lado del asistente
