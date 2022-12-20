<?php

namespace App\Http\Traits;

use App\Exceptions\NotFoundServiceClass;

trait EmailSender
{
    /**
     * @throws NotFoundServiceClass
     */
    public function sendMailWithServiceName($serviceClassName)
    {
        if(!class_exists($serviceClassName))
            throw new NotFoundServiceClass();

        (new $serviceClassName)();
    }
}

