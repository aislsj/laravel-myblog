<?php

namespace App\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    public function render()
    {
        // json() 方法第二个参数就是 Http 返回码
        return response()->json(['code' => $this->code, 'msg' => $this->message], 400);
    }
}
