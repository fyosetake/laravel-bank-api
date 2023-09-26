<?php

namespace App\Services;

use App\Models\CarteiraDigital;
use App\Exceptions\ContaException;

class ServicoConta
{
    public function criarConta($contaId, $valor)
    {
        $carteiraDigital = new CarteiraDigital();
        $carteiraDigital->conta_id = $contaId;
        $carteiraDigital->saldo = $valor;

        $carteiraDigital->save();

        return [
            'conta_id' => $contaId,
            'saldo' => $valor,
        ];
    }

    public function obterConta($contaId)
    {
        $conta = CarteiraDigital::where('conta_id', $contaId)->first();

        if (!$conta) {
            throw new ContaException();
        }

        return [
            'conta_id' => $conta->conta_id,
            'saldo' => $conta->saldo,
        ];
    }
}