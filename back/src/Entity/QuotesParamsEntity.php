<?php
    declare(strict_types=1);
    
    namespace App\Entity;
    
    use Symfony\Component\Validator\Constraints as Assert;

    final class QuotesParamsEntity
    {
        /**
         * @Assert\NotBlank(
         *     message= "symbol param should not be empty"
         * )
         */
        private $symbol;
        
        /**
         * @Assert\NotBlank
         * @Assert\Email(
         *     message = "The email is not a valid email."
         * )
         */
        private $email;
    
        /**
         * @Assert\NotBlank
         * @Assert\Date(
         *     message= "The provided value is not a valid date."
         * )
         * @var string A "Y-m-d" formatted value
         */
        private $startDate;
    
        /**
         * @Assert\NotBlank
         * @Assert\Date(
         *     message= "The provided value is not a valid date."
         * )
         * @var string A "Y-m-d" formatted value
         */
        private $endDate;
        
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
    }
