<?php

namespace App\Services\Validators;

use App\Exceptions\QuoteRequestValidationFailed;

interface QuoteValidateRequestInterface {
    /**
     * @throws QuoteRequestValidationFailed
     */
    public function validate(string $contentType): bool;
}