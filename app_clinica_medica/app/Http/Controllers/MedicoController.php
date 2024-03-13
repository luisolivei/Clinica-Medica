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
        // $medico = $this->medico->create($request->all());
        $request->validate($this->medico->rules(), $this->medico->feedback());
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $medico = $this->medico->create([
            'nome_medico' => $request->nome_medico,
            'id_especialidades' => $request->id_especialidades,
            'data_nascimento' => $request->data_nascimento,
            'telemovel' => $request->telemovel,
            'email' => $request->email,
            'imagem' => $request->imagem_urn,

        ]);



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
        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($medico->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas);
        } else {
            $request->validate($medico->rules());
        }


        $medico->fill($request->all());
        $medico->save();
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
