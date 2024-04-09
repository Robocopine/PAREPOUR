<?php

namespace App\Controller\App;

use App\Service\PaginationService;
use App\Repository\SectionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('', name: 'home')]
    public function index(SectionRepository $repository): Response
    {
        $resume = $repository->findOneBy(['title' => 'resume']);
        $goals = $repository->findOneBy(['title' => 'goals']);
        return $this->render('app/page/index.html.twig', [
            'controller_name' => 'Accueil',
            'controller_home' => 'home.description',
            'resume' => $resume,
            'goals' => $goals
        ]);
    }

    #[Route('/à-propos', name: 'about')]
    public function about(): Response
    {
        return $this->render('app/page/about.html.twig', [
            'controller_name' => 'À propos',
        ]);
    }

    #[Route('/évènements/{page<\d+>?1}', name: 'events')]
    public function events(PaginationService $pagination, $page): Response
    {
        //$pagination->setEntityClass(Event::class)
        //        ->setLimit(9)
        //        ->setPage($page);
        //;

        return $this->render('app/page/events.html.twig', [
            'controller_name' => 'Évenements',
            'pagination' => $pagination,
        ]);
    }

    #[Route('/réalisations', name: 'achievements')]
    public function achievements(): Response
    {
        return $this->render('app/page/achievements.html.twig', [
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
