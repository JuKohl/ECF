<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        HoursRepository $hoursRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $hours = $hoursRepository->findAll();

        $contact = new Contact();

        if($this->getUser()) {
            $contact->setName($this->getUser()->getName())
                ->setFirstName($this->getUser()->getFirstName())
                ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            
            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès.'
        );
        }

        return $this->render('pages/contact/contact.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }
}