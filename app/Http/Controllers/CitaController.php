<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $role=auth()->user()->role_id;

        //consultas para el administrador
        if($role==1){
            $citasPendientes = Cita::where('estado','Reservada')->paginate(10);
            $citasConfirmadas = Cita::where('estado','Confirmada')->paginate(10);
            $citasViejas= Cita::whereIn('estado',['Cancelada','Atendida'])->orderby('fecha_cita','DESC')->paginate(10);
        //consultas para el medico
        }else{
            $citasPendientes = Cita::where('estado','Reservada')->where('medico_id',auth()->id())->paginate(10);
            $citasConfirmadas = Cita::where('estado','Confirmada')->where('medico_id',auth()->id())->paginate(10);
            $citasViejas= Cita::whereIn('estado',['Cancelada','Atendida'])->where('medico_id',auth()->id())->paginate(10); */
       // }

        return view('citas.index'/* ,compact('citasConfirmadas','citasPendientes','citasViejas','role') */);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
