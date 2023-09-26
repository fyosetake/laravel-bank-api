<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObterContaController;
use App\Http\Controllers\CriarContaController;
use App\Http\Controllers\TransacaoController;

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

Route::post('/criarConta', [CriarContaController::class, 'criarConta']);

Route::get('/obterConta/{conta_id}', [ObterContaController::class, 'obterConta']);

Route::post('/transacao', [TransacaoController::class, 'processarTransacao']);