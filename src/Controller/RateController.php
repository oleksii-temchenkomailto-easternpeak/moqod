<?php

namespace App\Controller;

use App\Service\ExchangeRatesApi;
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
     * @param ExchangeRatesApi $exchanger
     * @return Response
     *
     * @Route("/", name="rate_index", methods={"GET"})
     */
    public function index(ExchangeRatesApi $exchanger): Response
    {
        $data = $exchanger->getLatest();
        return new JsonResponse($data);
    }
}
