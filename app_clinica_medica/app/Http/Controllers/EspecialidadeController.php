<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;
use App\Repositories\EspecialidadeRepository;

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
    public function index(Request $request)
    {
        // $especialidades = Especialidade::all();
        $especialidadeRepository = new EspecialidadeRepository($this->especialidade);

        if ($request->has('atributos_medicos', 'atributos_consultas')) {
            $atributos_medicos = 'medicos:id,' . $request->atributos_medicos;
            $atributos_consultas = 'consultas:id,' . $request->atributos_consultas;

            $especialidadeRepository->selectAtributosRegistrosRelacionados($atributos_medicos, $atributos_consultas);
        } else {
            $especialidadeRepository->selectAtributosRegistrosRelacionados('medicos', 'consultas');
        }

        if ($request->has('filtro')) {
            $especialidadeRepository->filtro($request->filtro);
        }


        if ($request->has('atributos')) {


            $especialidadeRepository->selectAtributos($request->atributos);
        }




        return response()->json($especialidadeRepository->getResultado(), 200);
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
        $especialidade = $this->especialidade->with('medicos', 'consultas')->find($id);
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

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($especialidade->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $especialidade->feedback());
        } else {
            $request->validate($especialidade->rules());
        }

        $especialidade->fill($request->all());
        $especialidade->save();
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
