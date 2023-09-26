<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServicoConta;
use App\Exceptions\ContaException;

class ContaController extends Controller
{
    protected $contaServico;

    public function __construct(ServicoConta $servicoConta)
    {
        $this->contaServico = $servicoConta;
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
            $resultadoCriacaoConta = $this->contaServico->criarConta($conta_id, $valor);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante a criação da conta.'], 500, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($resultadoCriacaoConta, 201);
    }

    public function obterConta($conta_id)
    {
        try {
            $resultadoConta = $this->contaServico->obterConta($conta_id);
        } catch (ContaException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode(), [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante a obtenção da conta.'], 500, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($resultadoConta, 200);
    }
}
