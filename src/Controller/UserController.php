<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'user.edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $entityManager, HoursRepository $hoursRepository): Response
    {
        $hours = $hoursRepository->findAll();


        if(!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home'); 
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }
}
