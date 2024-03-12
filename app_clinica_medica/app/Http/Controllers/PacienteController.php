<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    protected $paciente;
    public function __construct( Paciente $paciente) {
        $this->paciente = $paciente;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pacientes = Paciente::all();
        $pacientes = $this->paciente->all();
        return response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $paciente = Paciente::create($request->all());
        $paciente = $this->paciente->create($request->all());
        return response()->json($paciente, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     *
     */
    public function show($id)
    {
        $paciente = $this->paciente->find($id);
        if($paciente === null){
            return response()->json(['erro' => 'Paciente não encontrado'], 404);
        }
        return response()->json($paciente);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request, $id)
    {
        // $paciente->update($request->all());
        $paciente = $this->paciente->find($id);
        if($paciente === null){
            return response()->json(['erro' => 'Impossivel realizar a atualização. Paciente não encontrado'], 404);
        }
        $paciente->update($request->all());
        return response()->json($paciente, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $paciente = $this->paciente->find($id);
        if($paciente === null){
            return response()->json(['erro' => ' Impossivel realizar a exclusão. Paciente não encontrado'], 404);
        }
        $paciente->delete();
        return ['msg' => 'Paciente excluido com sucesso!'];
    }
}
