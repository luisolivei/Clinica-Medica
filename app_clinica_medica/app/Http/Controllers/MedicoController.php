<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;
use App\Repositories\MedicoRepository;
use Illuminate\Support\Facades\Storage;

class MedicoController extends Controller
{
    protected $medico;
    public function __construct(Medico $medico)
    {
        $this->medico = $medico;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {



        $medicoRepository = new MedicoRepository($this->medico);

        if ($request->has('atributos_especialidade', 'atributos_agenda')) {
            $atributos_especialidade = 'especialidade:id,' . $request->atributos_especialidade;
            $atributos_agenda = 'agenda:id,' . $request->atributos_agenda;

            $medicoRepository->selectAtributosRegistrosRelacionados($atributos_especialidade, $atributos_agenda);
        } else {

            $medicoRepository->selectAtributosRegistrosRelacionados('especialidade', 'agenda');
        }

        if ($request->has('filtro')) {
            $medicoRepository->filtro($request->filtro);
        }


        if ($request->has('atributos')) {

            $medicoRepository->selectAtributos($request->atributos);
        }




        return response()->json($medicoRepository->getResultado(), 200);


    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $medico = Medico::create($request->all());
        // $medico = $this->medico->create($request->all());
        $request->validate($this->medico->rules(), $this->medico->feedback());


        $medico = $this->medico->create([
            'nome_medico' => $request->nome_medico,
            'id_especialidades' => $request->id_especialidades,
            'data_nascimento' => $request->data_nascimento,
            'telemovel' => $request->telemovel,
            'email' => $request->email,
            'imagem' => $request->imagem_urn,

        ]);

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $medico->imagem = $imagem_urn;
        $medico->save();



        return response()->json($medico, 201);
    }

    /**
     * Display the specified resource.
     * @param Integer
     */
    public function show($id)
    {
        $medico = $this->medico->with('especialidade', 'agenda')->find($id);
        if ($medico === null) {
            return response()->json(['erro' => 'Medico não encontrado'], 404);
        }
        return response()->json($medico, 200);
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
            $request->validate($medico->rules(), $medico->feedback());

        }

        if ($request->file('imagem')) {
            Storage::disk('public')->delete($medico->imagem);
        }


        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');
         $medico->update([
             'nome_medico' => $request->nome_medico,
             'id_especialidades' => $request->id_especialidades,
             'data_nascimento' => $request->data_nascimento,
             'telemovel' => $request->telemovel,
             'email' => $request->email,
             'imagem' => $request->imagem_urn,

         ]);


        
        $medico->save();
        return response()->json($medico, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = $this->medico->find($id);
        if ($medico === null) {
            return response()->json(['erro' => 'Impossivel realizar a exclusão. Médico não encontrado'], 404);
        }

        Storage::disk('public')->delete($medico->imagem);

        $medico->delete();
        return response()->json(['msg' => 'Médico excluido com sucesso!'], 200);
    }
}
