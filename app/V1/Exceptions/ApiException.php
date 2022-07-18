<?php

namespace App\V1\Exceptions;
use Exception;

class ApiException extends Exception
{
    /*
     * This is custom exception will use to throw necessary exceptions to front
     * Other exceptions will be caught and send formatted message
     * Please refer render() method in App\Exceptions\Handler
     */
    public function __construct(string $message = "", int $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
