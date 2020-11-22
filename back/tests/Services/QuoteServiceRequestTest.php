<?php

namespace App\Tests\Services;

use App\Dto\QuoteRequestDataDto;
use App\Exceptions\RequestFailedException;
use App\Services\Email\QuoteSendEmailServiceInterface;
use App\Services\QuoteServiceRequest;
use App\Services\QuoteServiceUriInterface;
use Exception;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class QuoteServiceRequestTest extends MockeryTestCase
{
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @param array $mockResponseData
     * @param array $expected
     * @dataProvider dataProvider
     */
    public function testMakeCall(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email,
        array $mockResponseData,
        array $expected
    ) {
        $uri = 'testUri';
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $mockResponseInterface = Mockery::mock(ResponseInterface::class);
        $mockResponseInterface
            ->shouldReceive('getStatusCode')
            ->once()
            ->andReturn(200)
        ;
        
        $mockResponseInterface
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(json_encode($mockResponseData))
        ;
        
        $mockHttpClient = Mockery::mock(HttpClientInterface::class);
        
        $mockHttpClient
            ->shouldReceive('request')
            ->once()
            ->with('GET', $uri)
            ->andReturn($mockResponseInterface)
        ;
        
        $mockQuoteServiceUriInterface = Mockery::mock(QuoteServiceUriInterface::class);
        $mockQuoteServiceUriInterface
            ->shouldReceive('prepare')
            ->once()
            ->with($quoteRequestDataDto)
            ->andReturn($uri)
        ;
        
        $mockSendEmailServiceInterface = Mockery::mock(QuoteSendEmailServiceInterface::class);
        $mockSendEmailServiceInterface
            ->shouldReceive('sendEmail')
            ->once()
            ->with($quoteRequestDataDto)
            ->andReturnTrue()
        ;
        
        $sut = new QuoteServiceRequest(
            $mockHttpClient,
            $mockQuoteServiceUriInterface,
            $mockSendEmailServiceInterface
        );
        
        $actual = $sut->makeCall($quoteRequestDataDto);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @throws RequestFailedException
     * @dataProvider dataProviderThatThrowsRequestFailedException
     */
    public function testMakeCallThatThrowsRequestFailedException(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $this->expectException(RequestFailedException::class);
        
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        $uri = 'test';
    
        $mockHttpClient = Mockery::mock(HttpClientInterface::class);
        $mockHttpClient
            ->shouldReceive('request')
            ->once()
            ->with('GET', $uri)
            ->andThrow(Exception::class)
        ;
    
        $mockQuoteServiceUriInterface = Mockery::mock(QuoteServiceUriInterface::class);
        $mockQuoteServiceUriInterface
            ->shouldReceive('prepare')
            ->once()
            ->with($quoteRequestDataDto)
            ->andReturn($uri)
        ;
    
        $mockSendEmailServiceInterface = Mockery::mock(QuoteSendEmailServiceInterface::class);
        $mockSendEmailServiceInterface->shouldNotReceive('sendEmail');
    
        $sut = new QuoteServiceRequest(
            $mockHttpClient,
            $mockQuoteServiceUriInterface,
            $mockSendEmailServiceInterface
        );
        
        $sut->makeCall($quoteRequestDataDto);
    }
    
    
    /**
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @param array $mockResponseData
     * @param array $expected
     * @dataProvider dataProvider
     */
    public function testMakeCallEmailNotSended(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email,
        array $mockResponseData,
        array $expected
    ) {
        $uri = 'testUri';
        $quoteRequestDataDto = new QuoteRequestDataDto(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $mockResponseInterface = Mockery::mock(ResponseInterface::class);
        $mockResponseInterface
            ->shouldReceive('getStatusCode')
            ->once()
            ->andReturn(200)
        ;
        
        $mockResponseInterface
            ->shouldReceive('getContent')
            ->once()
            ->andReturn(json_encode($mockResponseData))
        ;
        
        $mockHttpClient = Mockery::mock(HttpClientInterface::class);
        
        $mockHttpClient
            ->shouldReceive('request')
            ->once()
            ->with('GET', $uri)
            ->andReturn($mockResponseInterface)
        ;
        
        $mockQuoteServiceUriInterface = Mockery::mock(QuoteServiceUriInterface::class);
        $mockQuoteServiceUriInterface
            ->shouldReceive('prepare')
            ->once()
            ->with($quoteRequestDataDto)
            ->andReturn($uri)
        ;
        
        $mockSendEmailServiceInterface = Mockery::mock(QuoteSendEmailServiceInterface::class);
        $mockSendEmailServiceInterface
            ->shouldReceive('sendEmail')
            ->once()
            ->with($quoteRequestDataDto)
            ->andReturnFalse()
        ;
        
        $sut = new QuoteServiceRequest(
            $mockHttpClient,
            $mockQuoteServiceUriInterface,
            $mockSendEmailServiceInterface
        );
        
        $actual = $sut->makeCall($quoteRequestDataDto);
        $this->assertEquals($expected, $actual);
    }
    
    public function dataProvider(): array
    {
        return [
            'valid' => [
                'symbol' => 'test',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
                'mockResponseData' => [
                    'data' => 'test'
                ],
                'expected' => [
                    'data' => 'test'
                ],
            ]
        ];
    }
    
    public function dataProviderThatThrowsRequestFailedException(): array
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
}
