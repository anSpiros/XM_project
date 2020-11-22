<?php
declare(strict_types=1);

namespace App\Services;

use App\Dto\QuoteRequestDataDto;
use App\Exceptions\RequestFailedException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

interface QuoteServiceRequestInterface
{
    /**
     *
     * @param QuoteRequestDataDto $quoteParamsDto
     * @return array
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RequestFailedException
     */
    public function makeCall(QuoteRequestDataDto $quoteParamsDto): array;
}