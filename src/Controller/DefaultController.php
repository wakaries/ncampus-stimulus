<?php

namespace App\Controller;

use App\Form\TestType;
use App\Service\TestCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(Request $request): Response
    {
        return $this->render('default/index.html.twig', [
            'page' => $request->get('page', 1)
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
        $form = $this->createForm(TestType::class, $request->getSession()->get('filter'));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request->getSession()->set('filter', $form->getData());
            return new Response(null, 204); // 204 Empty response
        }
        return $this->render('default/filter.html.twig', [
            'form' => $form->createView()
        ], new Response( null, $form->isSubmitted() && !$form->isValid()? 422 : 200)); // 422 Unprocessable entity - Validation errors
    }

    #[Route('/default/list', name: 'app_default_list')]
    public function list(TestCollection $collection, SessionInterface $session): Response
    {
        $currentPage = $session->get('page', 1);
        $items = $collection->getPage($currentPage, $session->get('filter'));

        return $this->render('default/list.html.twig', [
            'items' => $items['items'],
            'currentPage' => $items['currentPage'],
            'totalCount' => $items['totalCount'],
            'numberOfPages' => $items['numberOfPages']
        ]);
    }

    #[Route('/default/setpage', name: 'app_default_setpage')]
    public function setPage(Request $request): Response
    {
        $request->getSession()->set('page', $request->get('page'));
        return new Response('ok');
    }

    #[Route('/default/reset', name: 'app_default_reset')]
    public function reset(SessionInterface $session): Response
    {
        $session->set('filter', null);
        $session->set('page', 1);
        return new Response('ok');
    }
}
