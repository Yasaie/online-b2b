<?php

namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
    /**
     * Create a new authentication exception.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message = 'Access denied.')
    {
        parent::__construct($message, 403);
    }
}
