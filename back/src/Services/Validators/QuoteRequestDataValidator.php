<?php
declare(strict_types=1);

namespace App\Services\Validators;

use App\Entity\QuotesParamsEntity;
use App\Exceptions\ValidatedParamsException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class QuoteRequestDataValidator implements QuoteRequestDataValidatorInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws ValidatedParamsException
     */
    public function validate(
        string $symbol,
        string $startDate,
        string $endDate,
        string $email
    ): bool
    {
        $quotesParamsEntity = new QuotesParamsEntity(
            $symbol,
            $startDate,
            $endDate,
            $email
        );
        
        $violations = $this->validator->validate($quotesParamsEntity);
        if(count($violations) > 0) {
            $violationObjects = [];
            foreach ($violations as $violation) {
                $violationObjects[] = [
                    'field' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }
            
            throw new ValidatedParamsException("Validation failed", $violationObjects);
        }
        
        return true;
    }
}
