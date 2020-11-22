<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class RequestFailedException extends Exception
{
    private $data;
    
    public function __construct(string $message, Exception $data)
    {
        $this->data = $data;
        parent::__construct($message);
    }
    
    public function getData(): Exception
    {
        return $this->data;
    }
}
