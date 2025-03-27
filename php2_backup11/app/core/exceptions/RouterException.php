<?php
namespace app\core\exceptions;

use Exception;

class RouterException extends Exception
{
    public function __construct($message = "Route Not Found", $code = 404)
    {
        parent::__construct($message, $code);
    }
}