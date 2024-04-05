<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use App\Form\SectionType;
use App\Service\PaginationService;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/section', name: 'admin_section_')]
class SectionController extends AbstractController
{
    #[Route('s/{page<\d+>?1}', name: 'index', methods: ['GET'])]
    public function index(PaginationService $pagination, SectionRepository $sectionRepository, $page): Response
    {
        $pagination->setEntityClass(Section::class)
                ->setLimit(15)
                ->setPage($page);
        ;

        return $this->render('admin/section/index.html.twig', [
            'sections' => $sectionRepository->findAll(),
            'controller_name' => 'Liste des sections',
            'pagination' => $pagination,
        ]);
    }

    #[Route('/nouveau', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($section);
            $entityManager->flush();

            return $this->redirectToRoute('admin_section_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section/new.html.twig', [
            'section' => $section,
            'form' => $form,
            'controller_name' => 'Nouvelle section',
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Section $section): Response
    {
        return $this->render('admin/section/show.html.twig', [
            'section' => $section,
            'controller_name' => $section->getTitle(),
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Section $section, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_section_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/section/edit.html.twig', [
            'section' => $section,
            'form' => $form,
            'controller_name' => 'Modifier ' . $section->getTitle(),
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Section $section, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$section->getId(), $request->request->get('_token'))) {
            $entityManager->remove($section);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_section_index', [], Response::HTTP_SEE_OTHER);
    }
}
