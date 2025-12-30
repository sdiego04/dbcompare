<?php

namespace DBCompare\Exceptions;

use Exception;

class ExceptionDataBaseTimeOut extends Exception
{
    protected $message = 'Database connection timed out.';

    public function __construct($code = 0, ?Exception $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }
}