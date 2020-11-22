<?php

namespace App\Tests\Services\QuoteRequestDataFactory;

use App\Dto\QuoteRequestDataDto;
use App\Exceptions\ValidatedParamsException;
use App\Services\QuoteRequestDataFactory\QuoteRequestDataFactoryService;
use App\Services\Validators\QuoteRequestDataValidatorInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\TestCase;

class QuoteRequestDataFactoryServiceTest extends MockeryTestCase
{
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @dataProvider validDataProvider
     */
    public function testCreate(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $mockQuoteRequestDataValidatorInterface = Mockery::mock(QuoteRequestDataValidatorInterface::class);
        $mockQuoteRequestDataValidatorInterface
            ->shouldReceive('validate')
            ->once()
            ->with($symbol, $startDate, $endDate, $email)
            ->andReturnTrue()
        ;
        
        $sut = new QuoteRequestDataFactoryService($mockQuoteRequestDataValidatorInterface);
        
        $actual = $sut->create(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $expected = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @throws ValidatedParamsException
     * @dataProvider dataProviderThatThrowsValidatedParamsException
     */
    public function testCreateThatThrowsValidatedParamsException(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $this->expectException(ValidatedParamsException::class);
        
        $mockValidatedParamsException = new ValidatedParamsException("Validation failed", []);
        
        $mockQuoteRequestDataValidatorInterface = Mockery::mock(QuoteRequestDataValidatorInterface::class);
        $mockQuoteRequestDataValidatorInterface
            ->shouldReceive('validate')
            ->once()
            ->andThrow($mockValidatedParamsException)
        ;
    
        $sut = new QuoteRequestDataFactoryService($mockQuoteRequestDataValidatorInterface);
    
        $sut->create(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
    }
    
    public function validDataProvider(): array
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
    
    public function dataProviderThatThrowsValidatedParamsException(): array
    {
        return [
            'willThrowExceptionAtSymbol' => [
                'symbol' => '',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
            ]
        ];
    }
}
