<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paciente = Paciente::create($request->all());
        return response()->json($paciente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return response()->json($paciente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return response()->json($paciente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return ['msg' => 'Paciente excluido com sucesso!'];
    }
}
