<?php

namespace App\Exceptions;

use Exception;

class ApiAuthenticationException extends Exception
{
    protected $message = 'Unauthenticated API access.';
}
