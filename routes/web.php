<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\MedicoController;
use App\Http\Controllers\Medico\HorarioController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('citas',[App\Http\Controllers\CitaController::class, 'index']); //listar las citas


Route::middleware(['auth',/*  'admin' */])->group(function () {
    Route::resource('users', UserController::class)->names('admin.users');
    Route::resource('roles', RolController::class)->names('admin.roles');
    Route::resource('especialidades', EspecialidadController::class)->names('admin.especialidades');
    Route::resource('medicos', MedicoController::class)->names('admin.medicos');
});




//medicos
Route::middleware(['auth' ,'doctor' ])->group(function () {
    Route::get('horarios',[App\Http\Controllers\Medico\HorarioController::class, 'edit'])->name('pacientes.cita.edit');
    Route::post('horarios',[App\Http\Controllers\Medico\HorarioController::class, 'store'])->name('pacientes.cita.store');
});
 

///para reservar DE LADO DE PACIENTE
Route::middleware(['auth'/* ,'paciente' */])->group(function () {
    Route::get('reserva/create',[App\Http\Controllers\CitaController::class, 'create'])/* ->names('pacientes') */;
    Route::post('reserva',[App\Http\Controllers\CitaController::class, 'store'])/* ->names('pacientes') */;
});



//JSON
Route::get('/especialidades/{especialidad}/medicos',[App\Http\Controllers\Api\EspecialidadController::class, 'medicos']);
Route::get('/horarios/horas',[App\Http\Controllers\Api\HorarioController::class, 'horas']);


Route::get('agenda',[App\Http\Controllers\AgendaController::class, 'index']);
Route::get('agenda/mostrar',[App\Http\Controllers\AgendaController::class, 'show']);

