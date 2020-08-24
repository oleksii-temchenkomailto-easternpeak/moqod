<?php

namespace App\Controller;

use App\Service\ExchangeRatesApi;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rates")
 */
class RateController extends AbstractController
{
    /**
     * @Route("/{base}", defaults={"base"="EUR"}, name="rate_index", methods={"GET"})
     *
     * @param LoggerInterface $logger
     * @param ExchangeRatesApi $exchangerRates
     *
     * @return Response
     *
     */
    public function index(string $base, LoggerInterface $logger, ExchangeRatesApi $exchangerRates): Response
    {
        try {
            $rates = $exchangerRates->latest($base);
        } catch (\Exception $e){
            return new JsonResponse(['error' => $e->getMessage()]);
        }
        return new JsonResponse($rates);
    }
}
