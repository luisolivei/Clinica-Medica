<?php

use App\Models\Consulta;
use Illuminate\Http\Request;
use App\Models\Especialidade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\EspecialidadeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/consulta_especialidade', function () {
    $especialidade = Especialidade::with('consultas')->find(2);
   $consulta = Consulta::find(1);
   $especialidade->consultas()->saveMany([Consulta::find(2)]);

   $especialidade->refresh();

   return $especialidade;

});

Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('/pacientes', PacienteController::class);
Route::apiResource('/medicos', MedicoController::class);
Route::apiResource('/medicamento', MedicamentoController::class);
Route::apiResource('/especialidades', EspecialidadeController::class);
Route::apiResource('/agenda', AgendaController::class);
Route::apiResource('/consultas', ConsultaController::class);
