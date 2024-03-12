<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    protected $medico;
    public function __construct(Medico $medico)
    {
        $this->medico = $medico;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $medicos = Medico::all();
        $medicos = $this->medico->all();
        return response()->json($medicos ,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $medico = Medico::create($request->all());
        $medico = $this->medico->create($request->all());
        return response()->json($medico, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $medico = $this->medico->find($id);
        if ($medico === null) {
            return response()->json(['erro' => 'Medico não encontrado'], 404);
        }
        return response()->json($medico,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request, $id)
    {
        // $medico->update($request->all());
        $medico = $this->medico->find($id);
        if ($medico === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. Medico não encontrado'], 404);
        }
        $medico->update($request->all());
        return response()->json($medico, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $medico = $this->medico->find($id);
        if ($medico === null) {
            return response()->json(['erro' => 'Impossivel realizar a exclusão. Médico não encontrado'], 404);
        }
        $medico->delete();
        return response()->json(['msg' => 'Médico excluido com sucesso!'], 200);
    }
}
