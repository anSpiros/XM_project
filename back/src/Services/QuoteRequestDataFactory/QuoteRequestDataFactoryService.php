<?php
declare(strict_types=1);

namespace App\Services\QuoteRequestDataFactory;

use App\Dto\QuoteRequestDataDto;
use App\Services\Validators\QuoteRequestDataValidatorInterface;

final class QuoteRequestDataFactoryService implements QuoteRequestDataFactoryServiceInterface
{
    /**
     * @var QuoteRequestDataValidatorInterface
     */
    private $quoteRequestDataValidator;
    
    public function __construct(QuoteRequestDataValidatorInterface $quoteRequestDataValidator)
    {
        $this->quoteRequestDataValidator = $quoteRequestDataValidator;
    }
    
    public function create(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ): QuoteRequestDataDto {
        $this->quoteRequestDataValidator->validate($symbol, $startDate, $endDate, $email);
        
        return new QuoteRequestDataDto($symbol, $startDate, $endDate, $email);
    }
}
