<?php

namespace App\Services;

use App\Repositories\ContaRepository;
use App\Repositories\TransacaoRepository;
use App\Exceptions\TransacaoException;

class ServicoTransacao
{
    private $contaRepository;
    private $transacaoRepository;

    const TAXA_DEBITO = 1.03;
    const TAXA_CREDITO = 1.05;

    public function __construct(ContaRepository $contaRepository, TransacaoRepository $transacaoRepository)
    {
        $this->contaRepository = $contaRepository;
        $this->transacaoRepository = $transacaoRepository;
    }

    public function realizarTransacao($formaPagamento, $contaId, $valor)
    {
        $conta = $this->contaRepository->obterConta($contaId);

        $saldoAposTransacao = match ($formaPagamento) {
            'P' => $conta->saldo - $valor,
            'C' => $conta->saldo - $valor * self::TAXA_CREDITO,
            'D' => $conta->saldo - $valor * self::TAXA_DEBITO,
            default => $conta->saldo,
        };

        if ($saldoAposTransacao < 0) {
            throw new TransacaoException;
        }

        return $this->transacaoRepository->realizarTransacao($contaId, $valor, $formaPagamento, $saldoAposTransacao);
    }
}
