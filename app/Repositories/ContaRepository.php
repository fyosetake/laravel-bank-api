<?php

namespace App\Repositories;

use App\Models\CarteiraDigital;

class ContaRepository
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

        if ($conta) {
            return $conta;
        }

        return null;
    }
}
