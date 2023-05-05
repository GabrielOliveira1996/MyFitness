<?php

namespace App\Exceptions;

use Exception;

class ValidatorException extends Exception
{
    private $_errors;

    public function __construct($message, $code, $previous = null, $errors)
    {
        parent::__construct($message, $code, null);
        $this->_errors = $errors;
    }

    public function render()
    {
        return redirect()->back()->withErrors($this->_errors);
    }
}
