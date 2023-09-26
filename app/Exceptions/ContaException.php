<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ContaException extends HttpException
{
    public function __construct($message = 'Conta não encontrada', \Exception $previous = null, $code = 0, array $headers = [])
    {
        parent::__construct(404, $message, $previous, $headers, $code);
    }
}