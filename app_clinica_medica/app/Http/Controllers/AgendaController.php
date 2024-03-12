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
        return response()->json($agendas,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $agenda = Agenda::create($request->all());
        // $agenda = $this->agenda->create($request->all());
        $request->validate($this->agenda->rules(), $this->agenda->feedback());

        $agenda = $this->agenda->create([
            'id_medicos' => $request->id_medicos,
            'id_consultas' => $request->id_consultas,
            'data_agenda' => $request->data_agenda,
            'hora_agenda' => $request->hora_agenda,
            'status_agenda' => $request->status_agenda,

        ]);

        return response()->json($agenda, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $agenda = $this->agenda->find($id);
        if ($agenda === null) {
            return response()->json(['erro' => 'Agenda não encontrada'], 404);
        }
        return response()->json($agenda,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request, $id)
    {
        // $agenda->update($request->all());
        $agenda = $this->agenda->find($id);
        if ($agenda === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. Agenda não encontrada'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($agenda->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);
        } else {
            $request->validate($agenda->rules(), $agenda->feedback());;
        }

        $agenda->fill($request->all());
        $agenda->save();
        return response()->json($agenda, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $agenda = $this->agenda->find($id);
        if ($agenda === null) {
            return response()->json(['erro' => ' Impossivel realizar a exclusão. Agenda não encontrada'], 404);
        }
        $agenda->delete();
        return response()->json( ['msg' => 'Agenda excluida com sucesso!'], 200);
    }
}
