<?php

namespace App\Service;

use Twig\Environment;
use App\Entity\Section;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class VarsService {

  private $templatePath;
  private $twig;
  private $contact;
  private $entityClass;
  private $section;

  public function __construct(SectionRepository $sectionRepository, $templatePath, Environment $twig)
  {
    $this->sectionRepository = $sectionRepository;
    $this->templatePath = $templatePath;
    $this->twig = $twig;
  }

  // Gets pagination.html.twig
  public function getTemplatePath(){
    return $this->templatePath;
  }

  public function setTemplatePath($templatePath)
  {
    $this->templatePath = $templatePath;

    return $this;
  }

  // Entity of pagination to be defined in Controller
  public function getEntityClass()
  {
    return $this->entityClass;
  }

  public function setEntityClass($entityClass)
  {
    $this->entityClass = $entityClass;

    return $this;
  }

  public function getSection($entityClass)
  {
    $section = $this->sectionRepository->findOneBy(['title' => $entityClass]);
    
    return $section;
  }
  // Sends Data to template
  public function display(){
    $this->twig->display($this->templatePath, [
      'contact' => $this->getSection('contact'),
    ]);
  }

}