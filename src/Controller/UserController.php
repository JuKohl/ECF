<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\HoursRepository;
use App\Form\ChangePasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'app_user.edit')]
    public function edit(
        User $user, 
        Request $request, 
        EntityManagerInterface $entityManager, 
        HoursRepository $hoursRepository): Response
    {
        $hours = $hoursRepository->findAll();

        if($this->getUser() !== $user) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash(
                'success',
                'Les informations de votre compte ont bien été modifiées.'
        );
            
            //return $this->redirectToRoute('app_home');
        }
        
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }

    #[Route('/utilisateur/changement-mot-de-passe/{id}', name:'app_user.edit_password')]
    public function editPassword(
        User $user,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $userPasswordHasher,
        HoursRepository $hoursRepository): Response 
    {
        $hours = $hoursRepository->findAll();

        if($this->getUser() !== $user) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
                );
    
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );    

                //return $this->redirectToRoute('app_home');
            }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }
}
