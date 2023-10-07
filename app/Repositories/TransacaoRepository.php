<?php

namespace App\Repositories;

use App\Models\CarteiraDigital;
use App\Models\Transacao;

class TransacaoRepository
{
    public function realizarTransacao($contaId, $valor, $formaPagamento, $saldo)
    {
        $contaCarteiraDigital = CarteiraDigital::where('conta_id', $contaId)->first();
        $transacao = new Transacao();

        $transacao->conta_id = $contaId;
        $transacao->forma_pagamento = $formaPagamento;
        $transacao->valor = $valor;

        $contaCarteiraDigital->saldo = $saldo;
        $contaCarteiraDigital->save();
        $transacao->save();

        return [
            'conta_id' => $contaId,
            'saldo' => $saldo,
        ];
    }
}
