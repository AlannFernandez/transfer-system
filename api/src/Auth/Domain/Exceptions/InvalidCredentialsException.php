<?php

namespace Src\Auth\Domain\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Las credenciales ingresadas son incorrectas.';
}