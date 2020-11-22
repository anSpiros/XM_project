<?php
declare(strict_types=1);

namespace App\Services\Email;

use App\Dto\QuoteRequestDataDto;

interface QuoteSendEmailServiceInterface {
    public function sendEmail(QuoteRequestDataDto $quoteRequestData): bool;
}