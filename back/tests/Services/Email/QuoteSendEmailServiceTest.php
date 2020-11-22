<?php

namespace App\Tests\Services\Email;

use App\Dto\QuoteRequestDataDto;
use App\Services\Email\QuoteSendEmailService;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;

class QuoteSendEmailServiceTest extends MockeryTestCase
{
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @dataProvider dataProvider
     */
    public function testSendEmail(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $mockMailerInterface = Mockery::mock(MailerInterface::class);
        $mockMailerInterface
            ->shouldReceive('send')
            ->once()
        ;
        
        $sut = new QuoteSendEmailService($mockMailerInterface);
    
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $actual = $sut->sendEmail($quoteRequestDataDto);
        
        $this->assertEquals(true, $actual);
    }
    
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @dataProvider dataProviderThatThrowsTransportExceptionInterface
     */
    public function testSendEmailThatThrowsTransportExceptionInterface(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $mockMailerInterface = Mockery::mock(MailerInterface::class);
        $mockMailerInterface
            ->shouldReceive('send')
            ->once()
            ->andThrow(TransportException::class)
        ;
    
        $sut = new QuoteSendEmailService($mockMailerInterface);
    
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
    
        $actual = $sut->sendEmail($quoteRequestDataDto);
        
        $this->assertEquals(false, $actual);
    }
    
    public function dataProvider(): array
    {
        return [
            'valid' => [
                'symbol' => 'test',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
            ]
        ];
    }
    
    public function dataProviderThatThrowsTransportExceptionInterface(): array
    {
        return [
            's' => [
                'symbol' => 'test',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
            ]
        ];
    }
}
