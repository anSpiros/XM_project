<?php
declare(strict_types=1);

namespace App\Services\QuoteRequestDataFactory;

use App\Dto\QuoteRequestDataDto;
use App\Exceptions\ValidatedParamsException;

interface QuoteRequestDataFactoryServiceInterface
{
    /**
     * @throws ValidatedParamsException
     */
    public function create(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ): QuoteRequestDataDto;
}
