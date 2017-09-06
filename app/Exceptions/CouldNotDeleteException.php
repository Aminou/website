<?php

namespace App\Exceptions;

use Exception;

class CouldNotDeleteException extends Exception
{
    /**
     * Create a new Cant do this exception.
     *
     * @param  string  $message
     */
    public function __construct($message = 'This item could not be deleted')
    {
        parent::__construct($message);
    }

}