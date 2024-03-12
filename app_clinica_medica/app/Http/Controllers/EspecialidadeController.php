<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;

class EspecialidadeController extends Controller
{
    protected $especialidade;
    public function __construct(Especialidade $especialidade)
    {
        $this->especialidade = $especialidade;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $especialidades = Especialidade::all();
        $especialidades = $this->especialidade->all();
        return response()->json($especialidades ,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $especialidade = Especialidade::create($request->all());
        // $especialidade = $this->especialidade->create($request->all());
        $request->validate($this->especialidade->rules(), $this->especialidade->feedback());

        $especialidade = $this->especialidade->create([
            'nome_especialidade' => $request->nome_especialidade,
        ]);
        return response()->json($especialidade, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $especialidade = $this->especialidade->find($id);
        if ($especialidade === null) {
            return response()->json(['erro' => 'Especialidade não encontrada'], 404);
        }
        return response()->json($especialidade ,200);
    }

    /**
     * Update the specified resource in storage.
     * @param Integer
     */
    public function update(Request $request, $id)
    {
        // $especialidade->update($request->all());
        $especialidade = $this->especialidade->find($id);
        if ($especialidade === null) {
            return response()->json(['erro' => 'Impossivel realizar a atualização. Especialidade não encontrada'], 404);
        }

        $request->validate($this->especialidade->rules(), $this->especialidade->feedback());
        $especialidade->update($request->all());
        return response()->json($especialidade, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     */
    public function destroy($id)
    {
        $especialidade = $this->especialidade->find($id);
        if ($especialidade === null) {
            return response()->json(['erro' => ' Impossivel realizar a exclusão. Especialidade não encontrada'], 404);
        }
        $especialidade->delete();
        return response()->json(['msg' => 'Especialidade excluida com sucesso!'], 200);
    }
}
