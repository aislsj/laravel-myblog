<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class InternalException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function report()
    {
        Log::error($this->message);
    }
}
