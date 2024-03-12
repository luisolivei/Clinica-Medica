<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::apiResource('/pacientes', PacienteController::class);
Route::apiResource('/medicos', MedicoController::class);
Route::apiResource('/medicamento', MedicamentoController::class);
Route::apiResource('/especialidades', EspecialidadeController::class);
Route::apiResource('/agenda', AgendaController::class);
Route::apiResource('/consultas', ConsultaController::class);
