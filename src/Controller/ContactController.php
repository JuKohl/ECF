<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        HoursRepository $hoursRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
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

        //email
        $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('root@root.com')
            ->subject($contact->getSubject())
            ->htmlTemplate('emails/contact.html.twig')

            ->context([
                'contact' => $contact,
            ]);

        $mailer->send($email);
            
            $this->addFlash(
                'success',
                'Votre demande a été envoyée avec succès.'
        );
        }

        return $this->render('pages/contact/contact.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }
}