<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    protected $medicamento;
    public function __construct(Medicamento $medicamento)
    {
        $this->medicamento = $medicamento;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $medicamentos = Medicamento::all();
        $medicamentos = $this->medicamento->all();
        return response()->json($medicamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $medicamento = Medicamento::create($request->all());
        $medicamento = $this->medicamento->create($request->all());
        return response()->json($medicamento, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $medicamento = $this->medicamento->find($id);
        return response()->json($medicamento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        $medicamento->update($request->all());
        return response()->json($medicamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();
        return ['msg' => 'Medicamento excluido com sucesso!'];
    }
}
