<?php

namespace App\Tests\Services\Validators;

use App\Entity\QuotesParamsEntity;
use App\Exceptions\ValidatedParamsException;
use App\Services\Validators\QuoteRequestDataValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class QuoteRequestDataValidatorTest extends MockeryTestCase
{
    /**
     * @param array $mockValidatorReturn
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @param bool $expected
     * @dataProvider validDataProvider
     */
    public function testValidate(
        array $mockValidatorReturn,
        string $symbol,
        string $startDate,
        string $endDate,
        string $email,
        bool $expected
    ) {
        $mockValidatorInterface = Mockery::mock(ValidatorInterface::class);
        $mockValidatorInterface
            ->shouldReceive('validate')
            ->once()
            ->andReturn($mockValidatorReturn)
        ;
        
        $sut = new QuoteRequestDataValidator($mockValidatorInterface);
        
        $actual = $sut->validate(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @dataProvider dataProviderThatThrows
     * @param string $symbol
     * @param string $startDate
     * @param string $endDate
     * @param string $email
     * @throws ValidatedParamsException
     */
    public function testThatThrowsValidatedParamsException(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ) {
        $this->expectException(ValidatedParamsException::class);

        $mockConstraintViolationListInterface = Mockery::mock(ConstraintViolationInterface::class);
        $mockConstraintViolationListInterface
            ->shouldReceive('getPropertyPath')
            ->once()
            ->andReturn('testPropertyPath')
        ;

        $mockConstraintViolationListInterface
            ->shouldReceive('getMessage')
            ->once()
            ->andReturn('is empty')
        ;

        $mockValidatorInterface = Mockery::mock(ValidatorInterface::class);
        $mockValidatorInterface
            ->shouldReceive('validate')
            ->once()
            ->andReturn([$mockConstraintViolationListInterface])
        ;

        $sut = new QuoteRequestDataValidator($mockValidatorInterface);

        $sut->validate(
            $symbol,
            $startDate,
            $endDate,
            $email
        );

    }
    
    public function dataProviderThatThrows(): array
    {
        return [
            'dataForThrow' => [
                'symbol' => '',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
            ]
        ];
    }
    
    public function validDataProvider(): array
    {
        return [
            'valid' => [
                'mockValidatorReturn' => [],
                'symbol' => 'test',
                'startData' => '2020-10-20',
                'endDate' => '2020-11-20',
                'email' => 'test@mail.com',
                'expected' => true,
            ]
        ];
    }
}
