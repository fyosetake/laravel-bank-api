<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ServicoConta;

class CriarContaController extends Controller
{
    protected $servicoConta;

    public function __construct(ServicoConta $servicoConta)
    {
        $this->servicoConta = $servicoConta;
    }

    public function criarConta(Request $request)
    {
        if (!$request->filled(['conta_id', 'valor'])) {
            return response()->json([
                'Erro' => 'É necessário informar conta_id e valor para criar uma conta',
            ], 400, [], JSON_UNESCAPED_UNICODE);
        }

        $conta_id = $request->input('conta_id');
        $valor = $request->input('valor');

        try {
            $resultadoCriarConta = $this->servicoConta->criarConta($conta_id, $valor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante a criação da conta.'], 500, [], JSON_UNESCAPED_UNICODE);
        }

        return new Response($resultadoCriarConta, 201);
    }
}
