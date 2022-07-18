<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    #[Route('/figure', name: 'figure.index', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('pages/figure/index.html.twig', [
            'controller_name' => 'FigureController',
        ]);
    }
}
