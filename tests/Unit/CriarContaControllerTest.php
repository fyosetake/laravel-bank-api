<?php

use App\Http\Controllers\CriarContaController;
use App\Services\ServicoConta;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CriarContaControllerTest extends TestCase
{
    public function testCriarContaComSucesso()
    {
        $servicoContaMock = $this->getMockBuilder(ServicoConta::class)
            ->onlyMethods(['criarConta'])
            ->getMock();
        
        $resultadoEsperado = [
            'conta_id' => 1,
            'saldo' => 100.00,
        ];
        
        $servicoContaMock->expects($this->once())
            ->method('criarConta')
            ->willReturn($resultadoEsperado);
        
        $criarContaController = new CriarContaController($servicoContaMock);
        
        $request = new Request([
            'conta_id' => 1,
            'valor' => 100.00,
        ]);
        
        $resposta = $criarContaController->criarConta($request);
        
        $this->assertEquals(201, $resposta->getStatusCode());
        $this->assertEquals(json_encode($resultadoEsperado), $resposta->getContent());
    }
}
