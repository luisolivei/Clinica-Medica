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
        return response()->json($pacientes,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $paciente = Paciente::create($request->all());
        // $paciente = $this->paciente->create($request->all());
        $request->validate($this->paciente->rules(), $this->paciente->feedback());

        $paciente = $this->paciente->create([
            'nome_paciente' => $request->nome_paciente,
            'morada' => $request->morada,
            'data_nascimento' => $request->data_nascimento,
            'telemovel' => $request->telemovel,
            'email' => $request->email,
            'nif' => $request->nif,
            'genero' => $request->genero,




        ]);
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
        return response()->json($paciente,200);
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
        return response()->json(['msg' => 'Paciente excluido com sucesso!'], 200);
    }
}
