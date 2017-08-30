<?php

namespace App\Exceptions;

use Exception;

class CantDoThisException extends Exception
{
    /**
     * Create a new Cant do this exception.
     *
     * @param  string  $message
     */
    public function __construct($message = 'You Can\'t do this')
    {
        parent::__construct($message);
    }

}