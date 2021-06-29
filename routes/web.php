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
    /* return view('home'); */
    return redirect('/home');
});

Auth::routes();

Route::resource('users', UserController::class)->names('admin.users');
Route::resource('roles', RolController::class)->names('admin.roles');
Route::resource('especialidades', EspecialidadController::class)->names('admin.especialidades');
Route::resource('horarios', HorarioController::class)->names('admin.horaris');


Route::resource('medicos', MedicoController::class)->names('admin.medicos');
Route::get('/citas',[App\Http\Controllers\CitaController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
