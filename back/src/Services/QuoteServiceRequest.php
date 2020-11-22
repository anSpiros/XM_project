<?php
    declare(strict_types=1);
    
    namespace App\Services;

    use App\Dto\QuoteRequestDataDto;
    use App\Exceptions\RequestFailedException;
    use App\Services\Email\QuoteSendEmailServiceInterface;
    use Exception;
    use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
    use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
    use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
    use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
    use Symfony\Contracts\HttpClient\HttpClientInterface;


    final class QuoteServiceRequest implements QuoteServiceRequestInterface
    {
        const URI = "https://www.quandl.com/api/v3/datasets/WIKI/{symbol}.json?order=asc&start_date={Y-m-d}&end_date={ Y-m-d}";
        /**
         * @var HttpClientInterface
         */
        private $httpClient;
        /**
         * @var QuoteServiceUriInterface
         */
        private $quoteServiceUri;
        /**
         * @var QuoteSendEmailServiceInterface
         */
        private $quoteSendEmailService;
    
        public function __construct(
            HttpClientInterface $httpClient,
            QuoteServiceUriInterface $quoteServiceUri,
            QuoteSendEmailServiceInterface $quoteSendEmailService
        ) {
            $this->httpClient = $httpClient;
            $this->quoteServiceUri = $quoteServiceUri;
            $this->quoteSendEmailService = $quoteSendEmailService;
        }
    
        /**
         * @param QuoteRequestDataDto $quoteParamsDto
         * @return array
         * @throws TransportExceptionInterface
         * @throws ClientExceptionInterface
         * @throws RedirectionExceptionInterface
         * @throws ServerExceptionInterface*
         * @throws RequestFailedException
         */
        public function makeCall(QuoteRequestDataDto $quoteParamsDto): array
        {
            $uri = $this->quoteServiceUri->prepare($quoteParamsDto);
            try {
                $response = $this->httpClient->request("GET", $uri);
            } catch (Exception $exception) {
                throw new RequestFailedException('Request failed', $exception);
            }
            if($response->getStatusCode() === 200) {
                $this->quoteSendEmailService->sendEmail($quoteParamsDto);
                return json_decode($response->getContent(), true);
            }
            
            return [];
        }
    }
