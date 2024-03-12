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
        return response()->json($medicos);
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
     */
    public function show(Medico $medico)
    {
        return response()->json($medico);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        $medico->update($request->all());
        return response()->json($medico, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
        return ['msg' => 'Médico excluido com sucesso!'];
    }
}
