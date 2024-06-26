<?php

namespace App\Controller\App;

use App\Service\VarsService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/docs', name: 'document_')]
class DocController extends AbstractController
{
    public function __construct(VarsService $vars)
    {
        $this->vars = $vars;
    }
    
    #[Route('/vie-privée', name: 'privacy_policy')]
    public function privacy(): Response
    {
        $doc = "src/doc/Parepour_privacy_policy_fr.pdf";
        $docName = "Vie Privée";
        return $this->render('app/page/doc.html.twig', [
            'controller_name' => 'Document',
            'vars' => $this->vars,
            'doc' => $doc,
            'docName' => $docName,
        ]);
    }
    
    #[Route('/conditions-utilisations', name: 'terms_conditions')]
    public function terms(): Response
    {
        $doc = "src/doc/conditions_utilisation.pdf";
        $docName = "Conditions d'utilisations";
        return $this->render('app/page/doc.html.twig', [
            'controller_name' => 'Document',
            'vars' => $this->vars,
            'doc' => $doc,
            'docName' => $docName,
        ]);
    }



}
