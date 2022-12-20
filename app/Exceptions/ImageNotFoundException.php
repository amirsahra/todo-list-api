<?php

namespace App\Exceptions;

use Exception;

class ImageNotFoundException extends Exception
{
    protected $message = 'The image with this name and address does not exist.';
}
