<?php

namespace App\Tests\Services;

use App\Dto\QuoteRequestDataDto;
use App\Services\QuoteServiceUri;
use PHPUnit\Framework\TestCase;

class QuoteServiceUriTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @param string $domain
     * @param string $expected
     */
    public function testPrepare(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email,
        string $domain,
        string $expected
    ) {
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $sut = new QuoteServiceUri($domain);
        $actual = $sut->prepare($quoteRequestDataDto);
        
        $this->assertEquals($expected, $actual);
    }
    
    public function dataProvider(): array
    {
        return [
            'valid' => [
                'symbol' => 'testSymbol',
                'startDate' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
                'domain' => 'test-domain',
                'expected' => 'test-domain/testSymbol.json?order=asc&start_date=2020-10-20&end_date=2020-11-20',
            ]
        ];
    }
}
