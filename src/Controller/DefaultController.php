<?php

namespace App\Controller;

use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/default/ajax', name: 'app_default_ajax')]
    public function ajax(): Response
    {
        return $this->render('default/ajax.html.twig');
    }

    #[Route('/default/filter', name: 'app_default_filter')]
    public function filter(Request $request): Response
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            return new Response(null, 204); // 204 Empty response
        }
        return $this->render('default/filter.html.twig', [
            'form' => $form->createView()
        ], new Response( null, $form->isSubmitted() && !$form->isValid()? 422 : 200)); // 422 Unprocessable entity - Validation errors
    }

    #[Route('/default/list', name: 'app_default_list')]
    public function list(): Response
    {
        return $this->render('default/list.html.twig');
    }

}
