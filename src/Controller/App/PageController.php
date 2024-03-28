<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(): Response
    {
        return $this->render('app/page/index.html.twig', [
            'controller_name' => 'Accueil',
            'controller_home' => 'home.description',
        ]);
    }

    #[Route('/à-propos', name: 'about')]
    public function about(): Response
    {
        return $this->render('app/page/about.html.twig', [
            'controller_name' => 'À propos',
        ]);
    }

    #[Route('/évènements', name: 'evenements')]
    public function evenements(): Response
    {
        return $this->render('app/page/evenements.html.twig', [
            'controller_name' => 'Évenements',
        ]);
    }

    #[Route('/réalisations', name: 'realisations')]
    public function realisations(): Response
    {
        return $this->render('app/page/realisations.html.twig', [
            'controller_name' => 'Réalisations',
        ]);
    }

    #[Route('/sponsors', name: 'sponsors')]
    public function sponsors(): Response
    {
        return $this->render('app/page/sponsors.html.twig', [
            'controller_name' => 'Sponsors',
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('app/page/contact.html.twig', [
            'controller_name' => 'Contact',
        ]);
    }
}
