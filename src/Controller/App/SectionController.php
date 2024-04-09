<?php

namespace App\Controller\App;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/section', name: 'section_')]
class SectionController extends AbstractController
{
    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Section $section, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('section_close', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/partials/_sectionEdit.html.twig', [
            'section' => $section,
            'form' => $form,
        ]);
    }

    #[Route('/fermer', name: 'close')]
    public function close(): Response
    {
        return $this->renderForm('app/partials/_timeOut.html.twig', []);
    }
}