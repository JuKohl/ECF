<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\UserType;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/utilisateur/edition/{id}', name: 'user.edit')]
    public function edit(User $user, 
                        Request $request, 
                        EntityManagerInterface $entityManager, 
                        HoursRepository $hoursRepository): Response
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

    #[Route('/utilisateur/changement-mot-de-passe/{id}', name:'user.edit.password')]
    public function editPassword(User $user,
                                Request $request,
                                EntityManagerInterface $manager,
                                UserPasswordHasherInterface $userPasswordHasher,
                                HoursRepository $hoursRepository): Response 
    {
        $hours = $hoursRepository->findAll();

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
    
                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($user);
                $manager->flush();

                return $this->redirectToRoute('app_home');
                
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView(),
            'hours' => $hours,
        ]);
    }
}
