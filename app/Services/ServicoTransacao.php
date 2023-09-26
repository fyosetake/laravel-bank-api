<?php

namespace App\Services;

use App\Models\CarteiraDigital;
use App\Models\Transacao;
use App\Exceptions\TransacaoException;

class ServicoTransacao
{
    public function realizarTransacao($formaPagamento, $contaId, $valor)
    {
        $contaCarteiraDigital = CarteiraDigital::where('conta_id', $contaId)->first();
        $transacao = new Transacao();

        $transacao->conta_id = $contaId;
        $transacao->forma_pagamento = $formaPagamento;
        $transacao->valor = $valor;

        $saldoAposTransacao = match ($formaPagamento) {
            'P' => $contaCarteiraDigital->saldo - $valor,
            'C' => $contaCarteiraDigital->saldo - $valor * 1.05,
            'D' => $contaCarteiraDigital->saldo - $valor * 1.03,
            default => $contaCarteiraDigital->saldo,
        };

        if ($saldoAposTransacao < 0) {
            throw new TransacaoException;
        }

        $contaCarteiraDigital->saldo = $saldoAposTransacao;

        $contaCarteiraDigital->save();
        $transacao->save();

        return [
            'conta_id' => $contaId,
            'saldo' => $contaCarteiraDigital->saldo,
        ];
    }
}
