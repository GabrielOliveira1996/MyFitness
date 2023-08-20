<?php

namespace App\Exceptions;

use Exception;

class ValidatorException extends Exception
{
    private $_errors;
    private $_user;

    public function __construct($message, $code, $previous = null, $errors, $user)
    {
        parent::__construct($message, $code, $previous);
        $this->_errors = $errors;
        $this->_user = $user;
    }

    public function render()
    {
        return redirect()->back()
            ->withErrors($this->_errors)
            ->withInput($this->_user);
    }
}
