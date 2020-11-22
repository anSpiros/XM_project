<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class ValidatedParamsException extends Exception
{
    private $violations = [];
    
    public function __construct(string $message, array $violations)
    {
        $this->violations = $violations;
        parent::__construct($message);
    }

    public function getViolations(): array
    {
        return $this->violations;
    }
}
