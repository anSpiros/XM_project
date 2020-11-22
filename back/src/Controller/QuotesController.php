<?php

namespace App\Controller;

use App\Exceptions\QuoteRequestValidationFailed;
use App\Exceptions\RequestFailedException;
use App\Exceptions\ValidatedParamsException;
use App\Services\QuoteServiceRequestInterface;
use App\Services\QuoteRequestDataFactory\QuoteRequestDataFactoryServiceInterface;
use App\Services\Validators\QuoteValidateRequestInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuotesController extends AbstractController
{
    /**
     * @var QuoteRequestDataFactoryServiceInterface
     */
    private $quoteRequestDataFactoryService;
    /**
     * @var QuoteServiceRequestInterface
     */
    private $quoteServiceRequest;
    /**
     * @var QuoteValidateRequestInterface
     */
    private $quoteValidateRequest;
    
    public function __construct(
        QuoteRequestDataFactoryServiceInterface $quoteRequestDataFactoryService,
        QuoteServiceRequestInterface $quoteServiceRequest,
        QuoteValidateRequestInterface $quoteValidateRequest
    ) {
        $this->quoteRequestDataFactoryService = $quoteRequestDataFactoryService;
        $this->quoteServiceRequest = $quoteServiceRequest;
        $this->quoteValidateRequest = $quoteValidateRequest;
    }
    
    /**
     * @Route("/api/quotes", name="quotes", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $contentType = $request->headers->get('Content-Type', '');
        try {
            $this->quoteValidateRequest->validate($contentType);
        } catch (QuoteRequestValidationFailed $quoteRequestValidationFailed) {
            return $this->json([
               'errors' => $quoteRequestValidationFailed->getMessage()
           ], 415);
        }
        
        $request->request = new ParameterBag(json_decode($request->getContent(), true));
        
        try {
            $quoteRequestData = $this->quoteRequestDataFactoryService->create(
                $request->request->get('symbol', ''),
                $request->request->get('startDate', ''),
                $request->request->get('endDate', ''),
                $request->request->get('email', '')
            );
        } catch (ValidatedParamsException $exception) {
            return $this->json([
                'message' => 'Validation failed',
                'errors' => $exception->getViolations()
            ], 400);
        }
        
        try {
            $response = $this->quoteServiceRequest->makeCall($quoteRequestData);
        } catch (RequestFailedException $requestFailedException) {
            return $this->json([
               'message' => $requestFailedException->getMessage(),
               'errors' => $requestFailedException->getData()->getMessage()
           ], 400);
        }
        
        if(empty($response)) {
            return $this->json([
               'message' => 'Error communicating with service'
           ], 503);
        }
        
        return $this->json([
           'message' => 'success',
           'data' => $response,
       ]);
    }
}
