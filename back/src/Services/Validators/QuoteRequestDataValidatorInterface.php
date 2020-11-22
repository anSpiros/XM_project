<?php
declare(strict_types=1);

namespace App\Services\Validators;

use App\Exceptions\ValidatedParamsException;

interface QuoteRequestDataValidatorInterface {
    
    /**
     * @throws ValidatedParamsException
     */
    public function validate(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    );
}
