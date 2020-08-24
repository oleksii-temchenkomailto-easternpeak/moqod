<?php

namespace App\Controller;

use App\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RateController extends AbstractController
{
    /**
     * @Route("/crate", name="create_rate")
     */
    public function createProduct(ValidatorInterface $validator): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $rate = new Rate();
//        $product->setName('Keyboard');
//        $product->setPrice(1999);
//        $product->setDescription('Ergonomic and stylish!');
//
//        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($rate);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$rate->getId());
    }

    /**
     * @Route("/rate", name="rate")
     */
    public function index()
    {
        return $this->render('rate/index.html.twig', [
            'controller_name' => 'RateController',
        ]);
    }
}
