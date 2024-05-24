<?php

namespace App\Controller\App;

use App\Entity\Event;
use App\Entity\Achievement;
use App\Service\VarsService;
use App\Service\PaginationService;
use App\Repository\SectionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    public function __construct(VarsService $vars)
    {
        $this->vars = $vars;
    }

    #[Route('', name: 'home')]
    public function index(): Response
    {
        return $this->render('app/page/index.html.twig', [
            'controller_name' => 'Accueil',
            'controller_home' => 'home.description',
            'resume' => $this->vars->getSection('resume'),
            'goals' => $this->vars->getSection('goals'),
            'vars' => $this->vars,
        ]);
    }

    #[Route('/à-propos', name: 'about')]
    public function about(): Response
    {
        return $this->render('app/page/about.html.twig', [
            'controller_name' => 'À propos',
            'about' => $this->vars->getSection('about'),
            'notice' => $this->vars->getSection('notice'),
            'vars' => $this->vars,
        ]);
    }

    #[Route('/évènements/{page<\d+>?1}', name: 'events')]
    public function events(PaginationService $pagination, $page): Response
    {
        $pagination->setEntityClass(Event::class)
                ->setLimit(9)
                ->setPage($page);

        return $this->render('app/page/events.html.twig', [
            'controller_name' => 'Évenements',
            'pagination' => $pagination,
            'vars' => $this->vars,
        ]);
    }

    #[Route('/réalisations/{page<\d+>?1}', name: 'achievements')]
    public function achievements(PaginationService $pagination, $page): Response
    {
        $pagination->setEntityClass(Achievement::class)
                ->setLimit(9)
                ->setPage($page);

        return $this->render('app/page/achievements.html.twig', [
            'controller_name' => 'Réalisations',
            'pagination' => $pagination,
            'vars' => $this->vars,
        ]);
    }

    #[Route('/sponsors', name: 'sponsors')]
    public function sponsors(): Response
    {
        return $this->render('app/page/sponsors.html.twig', [
            'controller_name' => 'Sponsors',
            'vars' => $this->vars,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('app/page/contact.html.twig', [
            'controller_name' => 'Contact',
            'vars' => $this->vars
        ]);
    }
}
