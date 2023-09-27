<?php

use App\Http\Controllers\ObterContaController;
use App\Services\ServicoConta;
use PHPUnit\Framework\TestCase;

class ObterContaControllerTest extends TestCase
{
    public function testObterContaComSucesso()
    {
        $servicoContaMock = $this->getMockBuilder(ServicoConta::class)
            ->onlyMethods(['obterConta'])
            ->getMock();
        
        $resultadoEsperado = [
            'conta_id' => 1,
            'saldo' => 100.00,
        ];

        $conta_id = 1;
        
        $servicoContaMock->expects($this->once())
            ->method('obterConta')
            ->willReturn($resultadoEsperado);
        
        $obterContaController = new ObterContaController($servicoContaMock);
        
        $resposta = $obterContaController->obterConta($conta_id);
        
        $this->assertSame(200, $resposta->getStatusCode());
        $this->assertSame(json_encode($resultadoEsperado), $resposta->getContent());
    }
}
