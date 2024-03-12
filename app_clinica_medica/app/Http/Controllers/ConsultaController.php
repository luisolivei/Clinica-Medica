<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;


class ConsultaController extends Controller
{
    protected $consulta;
    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $consultas = Consulta::all();
        $consultas = $this->consulta->all();
        return response()->json($consultas ,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $consulta = Consulta::create($request->all());
        // $consulta = $this->consulta->create($request->all());
        $request->validate($this->consulta->rules(), $this->consulta->feedback());

        $consulta = $this->consulta->create([
            'id_pacientes' => $request->id_pacientes,
            'data_consulta' => $request->data_consulta,
            'hora_consulta' => $request->hora_consulta,
            'status_consulta' => $request->status_consulta,
            'descricao_consulta' => $request->descricao_consulta,
            'NumeroConsulta' => $request->NumeroConsulta

        ]);


        return response()->json($consulta, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $consulta = $this->consulta->find($id);
        if ($consulta === null) {
            return response()->json(['erro' => 'Consulta não encontrada'], 404);
        }
        return response()->json($consulta ,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request, $id)
    {
        // $consulta->update($request->all());
        $consulta = $this->consulta->find($id);
        if ($consulta === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. Consulta não encontrada'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($consulta->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);
        } else {
            $request->validate($consulta->rules(), $consulta->feedback());;
        }

        $consulta->fill($request->all());
        $consulta->save();
        return response()->json($consulta, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $consulta = $this->consulta->find($id);
        if ($consulta === null) {
            return response()->json(['erro' => ' Impossivel realizar a exclusão. Consulta não encontrada'], 404);
        }
        $consulta->delete();
        return response()->json(['msg' => 'Consulta excluida com sucesso!'], 200);
    }
}
