<?php

namespace App\Tests\Services\Validators;

use App\Exceptions\QuoteRequestValidationFailed;
use App\Services\Validators\QuoteValidateRequest;
use PHPUnit\Framework\TestCase;

class QuoteValidateRequestTest extends TestCase
{
    
    public function testValidate()
    {
        $contentType = 'application/json';
        $sut = new QuoteValidateRequest();
        $actual = $sut->validate($contentType);
        $this->assertEquals(true, $actual);
    }
    
    /**
     * @dataProvider invalidContentTypes
     */
    public function testValidateThatThrowsQuoteRequestValidationFailed(
        string $contentType
    ) {
        $this->expectException(QuoteRequestValidationFailed::class);
        $sut = new QuoteValidateRequest();
        $sut->validate($contentType);
    }
    
    public function invalidContentTypes()
    {
        return [
            'empty' => [
                'contentType' => '',
            ],
            'invalid' => [
                'contentType' => 'invalid',
            ],
        ];
    }
}
