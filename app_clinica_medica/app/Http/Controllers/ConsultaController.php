<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = Consulta::all();
        return response()->json($consultas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $consulta = Consulta::create($request->all());
        return response()->json($consulta, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        return response()->json($consulta);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        $consulta->update($request->all());
        return response()->json($consulta, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
        return ['msg' => 'Consulta excluida com sucesso!'];
    }
}
