<?php
    declare(strict_types=1);
    
    namespace App\Dto;
    
    final class QuoteRequestDataDto
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
        private $endDate;
        /**
         * @var string
         */
        private $email;
    
        public function __construct(
            string $symbol,
            string $startDate,
            string $endDate,
            string $email
        ) {
            $this->symbol = $symbol;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->email = $email;
        }
    
        /**
         * @return string
         */
        public function getSymbol(): string
        {
            return $this->symbol;
        }
    
        /**
         * @return string
         */
        public function getStartDate(): string
        {
            return $this->startDate;
        }
    
        /**
         * @return string
         */
        public function getEndDate(): string
        {
            return $this->endDate;
        }
    
        /**
         * @return string
         */
        public function getEmail(): string
        {
            return $this->email;
        }
        
    }
