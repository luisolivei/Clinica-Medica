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
        return response()->json($medicamentos ,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $medicamento = Medicamento::create($request->all());
        // $medicamento = $this->medicamento->create($request->all());
        $request->validate($this->medicamento->rules(), $this->medicamento->feedback());

        $medicamento = $this->medicamento->create([
            'nome' => $request->nome,
            'dosagem' => $request->dosagem,
            'descricao' => $request->descricao,
            'data_validade' => $request->data_validade,
        ]);
        return response()->json($medicamento, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $medicamento = $this->medicamento->find($id);
        if ($medicamento === null) {
            return response()->json(['erro' => 'Medicamento não encontrado'], 404);
        }
        return response()->json($medicamento,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request,$id)
    {
        // $medicamento->update($request->all());
        $medicamento = $this->medicamento->find($id);
        if ($medicamento === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. Medicamento não encontrado'], 404);
        }
        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($medicamento->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);
        } else {
            $request->validate($medicamento->rules(), $medicamento->feedback());;
        }

        $medicamento->fill($request->all());
        $medicamento->save();
        return response()->json($medicamento, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $medicamento = $this->medicamento->find($id);
        if ($medicamento === null) {
            return response()->json(['erro' => ' Impossivel realizar a exclusão. Medicamento não encontrado'], 404);
        }
        $medicamento->delete();
        return response()->json(['msg' => 'Medicamento excluido com sucesso!'], 200);
    }
}
