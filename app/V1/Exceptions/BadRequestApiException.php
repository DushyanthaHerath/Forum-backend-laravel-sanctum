<?php

namespace App\V1\Exceptions;

class BadRequestApiException extends \Exception
{
    /**
     * @param string $message
     * @param \Throwable|null $previous
     */
    public function __construct($message = '', ?\Throwable $previous = null)
    {
        if (empty($message)) {
            $message = 'The server cannot process the request due to its malformed syntax.';
        }

        parent::__construct($message, 400, $previous);
    }
}
