<?php

namespace App\Services;

use App\Repositories\ContaRepository;
use App\Exceptions\ContaException;

class ServicoConta
{
    private $contaRepository;

    public function __construct(ContaRepository $contaRepository)
    {
        $this->contaRepository = $contaRepository;
    }

    public function criarConta($contaId, $valor)
    {
        return $this->contaRepository->criarConta($contaId, $valor);
    }

    public function obterConta($contaId)
    {
        $conta = $this->contaRepository->obterConta($contaId);

        if (!$conta) {
            throw new ContaException();
        }

        return $conta;
    }
}
