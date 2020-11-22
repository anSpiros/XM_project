<?php
declare(strict_types=1);

namespace App\Services\Email;

use App\Dto\QuoteRequestDataDto;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class QuoteSendEmailService implements QuoteSendEmailServiceInterface
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    public function sendEmail(QuoteRequestDataDto $quoteRequestData): bool
    {
        $symbol = $quoteRequestData->getSymbol();
        $startDate = $quoteRequestData->getStartDate();
        $endDate = $quoteRequestData->getEndDate();
        $givenEmail = $quoteRequestData->getEmail();
        $email = (new Email())
            ->from('test_project@example.com')
            ->to($givenEmail)
            ->subject($symbol)
            ->text("{$startDate} - {$endDate}");
        
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return false;
        }
        
        return true;
    }
}
