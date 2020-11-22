<?php
    declare(strict_types=1);
    
    namespace App\Services;
    
    use App\Dto\QuoteRequestDataDto;

    final class QuoteServiceUri implements QuoteServiceUriInterface
    {
        /**
         * @var string
         */
        private $domain;
    
        public function __construct(string $domain)
        {
            $this->domain = $domain;
        }
    
        public function prepare(QuoteRequestDataDto $quoteParamsDto): string
        {
            $domain = $this->domain;
            $symbol = $quoteParamsDto->getSymbol();
            $startDate = $quoteParamsDto->getStartDate();
            $endDate = $quoteParamsDto->getEndDate();
            
            return "{$domain}/{$symbol}.json?order=asc&start_date={$startDate}&end_date={$endDate}";
        }
    }
