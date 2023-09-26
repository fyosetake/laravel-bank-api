<?php

namespace App\Http\Controllers;

use App\Services\ServicoConta;
use App\Exceptions\ContaException;

class ObterContaController extends Controller
{
    protected $servicoConta;

    public function __construct(ServicoConta $servicoConta)
    {
        $this->servicoConta = $servicoConta;
    }

    public function obterConta($conta_id)
    {
        try {
            $resultadoObterConta = $this->servicoConta->obterConta($conta_id);
        } catch (ContaException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode(), [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro durante a obtenção da conta.'], 500, [], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($resultadoObterConta, 200);
    }
}
