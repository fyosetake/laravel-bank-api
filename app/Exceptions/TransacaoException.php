<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class TransacaoException extends HttpException
{
    public function __construct(
        $message = 'Saldo insuficiente para realizar esta transação!', 
        \Exception $previous = null, 
        $code = 0, 
        array $headers = [])
    {
        parent::__construct(404, $message, $previous, $headers, $code);
    }
}