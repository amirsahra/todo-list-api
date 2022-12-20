<?php

namespace App\Exceptions;

use Exception;

class NotFoundServiceClass extends Exception
{
    protected $message ='There is no service class with this name and path.';
}
