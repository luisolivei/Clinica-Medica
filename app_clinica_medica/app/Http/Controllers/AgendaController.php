<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    protected $agenda;
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $agendas = Agenda::all();
        $agendas = $this->agenda->all();
        return response()->json($agendas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $agenda = Agenda::create($request->all());
        $agenda = $this->agenda->create($request->all());
        return response()->json($agenda, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $agenda = $this->agenda->find($id);
        return response()->json($agenda);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
    {
        $agenda->update($request->all());
        return response()->json($agenda, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return ['msg' => 'Agenda excluida com sucesso!'];
    }
}
