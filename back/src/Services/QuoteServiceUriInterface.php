<?php
    declare(strict_types=1);
    
    namespace App\Services;
    
    use App\Dto\QuoteRequestDataDto;
    
    interface QuoteServiceUriInterface {
        public function prepare(QuoteRequestDataDto $quoteParamsDto): string;
    }