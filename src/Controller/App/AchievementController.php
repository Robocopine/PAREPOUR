<?php

namespace App\Controller\App;

use App\Entity\Achievement;
use App\Service\VarsService;
use App\Form\AchievementType;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/réalisation', name: 'achievement_')]
class AchievementController extends AbstractController
{
    public function __construct(VarsService $vars)
    {
        $this->vars = $vars;
    }
    
    #[Route('s/{page<\d+>?1}', name: 'index')]
    public function index(PaginationService $pagination, $page): Response
    {
        $pagination->setEntityClass(Achievement::class)
                ->setLimit(9)
                ->setPage($page);

        return $this->render('app/achievement/index.html.twig', [
            'controller_name' => 'Réalisations',
            'pagination' => $pagination,
            'vars' => $this->vars,
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $achievement = new Achievement();
        $form = $this->createForm(AchievementType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($achievement);
            $entityManager->flush();

            return $this->redirectToRoute('achievement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/achievement/new.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
            'controller_name' => 'Créer une réalisations',
            'vars' => $this->vars,
        ]);
    }
}
