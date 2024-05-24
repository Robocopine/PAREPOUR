<?php

namespace App\Controller\Admin;

use App\Entity\Achievement;
use App\Form\AchievementType;
use App\Service\PaginationService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AchievementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/réalisation', name: 'admin_achievement_')]
class AchievementController extends AbstractController
{
    #[Route('s/{page<\d+>?1}', name: 'index', methods: ['GET'])]
    public function index(PaginationService $pagination, AchievementRepository $achievementRepository, $page): Response
    {
        $pagination->setEntityClass(Achievement::class)
                ->setLimit(15)
                ->setPage($page);
        ;

        return $this->render('admin/achievement/index.html.twig', [
            'achievements' => $achievementRepository->findAll(),
            'controller_name' => 'Liste des réalisations',
            'pagination' => $pagination,
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

            return $this->redirectToRoute('admin_achievement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/achievement/new.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Achievement $achievement): Response
    {
        return $this->render('admin/achievement/show.html.twig', [
            'achievement' => $achievement,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achievement $achievement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AchievementType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_achievement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/achievement/edit.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Achievement $achievement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achievement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($achievement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_achievement_index', [], Response::HTTP_SEE_OTHER);
    }
}
