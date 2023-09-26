<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServicoTransacao;
use App\Exceptions\TransacaoException;

class TransacaoController extends Controller
{
    protected $servicoTransacao;

    public function __construct(ServicoTransacao $servicoTransacao)
    {
        $this->servicoTransacao = $servicoTransacao;
    }

    public function processarTransacao(Request $request) 
    {
        if (!$request->filled(['forma_pagamento', 'conta_id', 'valor'])) {
            return response()->json([
                'Erro' => 'É necessário informar forma_pagamento, conta_id e valor para efetuar uma transação',
            ], 400, [], JSON_UNESCAPED_UNICODE);
        }

        $forma_pagamento = $request->input('forma_pagamento');
        $conta_id = $request->input('conta_id');
        $valor = $request->input('valor');

        try {
            $resultadoTransacao = $this->servicoTransacao->realizarTransacao($forma_pagamento, $conta_id, $valor);
        } catch (TransacaoException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode(), [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante esta transação!'], 500, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($resultadoTransacao, 201);
    }
}
