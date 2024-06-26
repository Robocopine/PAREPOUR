<?php

namespace App\Controller\App;

use App\Classe\Mail;
use App\Entity\Contact;
use App\Entity\Donator;
use App\Form\ContactType;
use App\Service\VarsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    public function __construct(VarsService $vars, EntityManagerInterface $entityManager)
    {
        $this->vars = $vars;
        $this->entityManager = $entityManager;
    }
    
    #[Route('/contact', name: 'contact', methods: ['GET', 'POST'])]
    public function contact(Request $request): Response
    {
        // get contact form by var
        $contactName = htmlspecialchars($request->request->get('name'));
        $contactEmail = htmlspecialchars($request->request->get('email'));
        $contactPhone = htmlspecialchars($request->request->get('phone'));
        $contactMessage = htmlspecialchars($request->request->get('message'));

        // Create a Contact Entity
        $contact = new Contact();    
        //Setter    
        $contact->setFullName($contactName);
        $contact->setMail($contactEmail);
        $contact->setPhone($contactPhone);
        $contact->setMessage($contactMessage);
        // Treat informations
        $this->entityManager->persist($contact);
        $this->entityManager->flush();
        // do anything else you need here, like send an email
        $this->addFlash(
            'contact',
            'Merci de votre demande, nous vous répondrons dans les meilleurs délais'
        );
        // Send a mail to contact and to parepour
        $mail = new Mail();
        $subject = 'PAREPOUR : Message de '.$contactName;
        // Mail To contact
        $mail->sendToUser($contactEmail, $contactName, $contactPhone, 6086077, $subject, $contactMessage);
        // Mail To PAREPOUR
        $mail->sendToPAREPOUR($contactEmail, $contactName, $contactPhone, 6086652, $subject, $contactMessage);
        return $this->redirectToRoute('home');
    }

    #[Route('/don', name: 'donate', methods: ['GET', 'POST'])]
    public function donate(Request $request): Response
    {
        // get contact form by var
        $donatorName = htmlspecialchars($request->request->get('name'));
        $donatorEmail = htmlspecialchars($request->request->get('email'));
        $donatorPhone = htmlspecialchars($request->request->get('phone'));
        $donatorMessage = htmlspecialchars($request->request->get('message'));

        // Create a Contact Entity
        $donator = new Donator();    
        //Setter    
        $donator->setFullName($donatorName);
        $donator->setMail($donatorEmail);
        $donator->setPhone($donatorPhone);
        $donator->setMessage($donatorMessage);
        // Treat informations
        $this->entityManager->persist($donator);
        $this->entityManager->flush();
        // do anything else you need here, like send an email
        $this->addFlash(
            'donate',
            'PAREPOUR vous remercie pour votre contribution'
        );
        // Send a mail to donator and to parepour
        $mail = new Mail();
        $subject = 'PAREPOUR : Contribution de '.$donatorName;
        // Mail To Donator
        $mail->sendToUser($donatorEmail, $donatorName, $donatorPhone, 6086635, $subject, $donatorMessage);
        // Mail To PAREPOUR
        $mail->sendToPAREPOUR($donatorEmail, $donatorName, $donatorPhone, 6086623, $subject, $donatorMessage);
        return $this->redirectToRoute('home');
    }
}
