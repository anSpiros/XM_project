<?php
declare(strict_types=1);

namespace App\Services\Validators;

use App\Exceptions\QuoteRequestValidationFailed;

final class QuoteValidateRequest implements QuoteValidateRequestInterface
{
    public function validate(string $contentType): bool
    {
        if (strpos($contentType, 'application/json') === false) {
           throw new QuoteRequestValidationFailed("Content type not allowed");
        }
        
        return true;
    }
}
