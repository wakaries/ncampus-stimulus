<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetronicController extends AbstractController
{
    #[Route('/metronic', name: 'app_metronic')]
    public function index(): Response
    {
        return $this->render('metronic/index.html.twig', [
            'controller_name' => 'MetronicController',
        ]);
    }
}
