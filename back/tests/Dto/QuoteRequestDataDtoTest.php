<?php

namespace App\Tests\Dto;

use App\Dto\QuoteRequestDataDto;
use PHPUnit\Framework\TestCase;

class QuoteRequestDataDtoTest extends TestCase
{
    
    /**
     * @var string
     */
    private $symbol;
    /**
     * @var string
     */
    private $startDate;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $endDate;
    /**
     * @var QuoteRequestDataDto
     */
    private $actual;
    
    public function setUp()
    {
        $this->symbol = "test";
        $this->startDate = "2020-10-22";
        $this->endDate = "2020-11-20";
        $this->email = "test@mail.com";
        $this->actual = new QuoteRequestDataDto(
           $this->symbol,
           $this->startDate,
           $this->endDate,
           $this->email
        );
    }
    
    public function testGetSymbol()
    {
        $this->assertEquals($this->symbol, $this->actual->getSymbol());
    }
    
    public function testGetStartDate()
    {
        $this->assertEquals($this->startDate, $this->actual->getStartDate());
    }
    
    public function testGetEmail()
    {
        $this->assertEquals($this->email, $this->actual->getEmail());
    }
    
    public function testGetEndDate()
    {
        $this->assertEquals($this->endDate, $this->actual->getEndDate());
    }
    
    protected function tearDown()
    {
       unset($this->symbol);
       unset($this->startDate);
       unset($this->endDate);
       unset($this->email);
       unset($this->actual);
    }
}
