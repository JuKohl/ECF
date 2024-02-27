<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Form\ReviewType;
use App\Repository\HoursRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        HoursRepository $hoursRepository, 
        ServicesRepository $servicesRepository, 
        Request $request, 
        EntityManagerInterface $entityManagerInterface, 
        Security $security, 
        ReviewsRepository $reviewsRepository): Response
    {
        $hours = $hoursRepository->findAll();
        $services = $servicesRepository->findAll();
        $websiteName = 'Garage V. Parrot';
        $user = $security->getUser();

        $reviews = $reviewsRepository->findBy(['approved' => true]);
        $newReview = null;
        $form = null;
        if($user) {
            $newReview = $reviewsRepository->findOneBy(['user' => $user]);
        
            if(!$newReview) {
                $newReview = new Reviews();
                $newReview->setUser($user);
                $newReview->setApproved(false);
            }
            $form = $this->createForm(ReviewType::class, $newReview);
            $form->handleRequest($request);

            $newReview->setCreatedAt(new \DateTimeImmutable());

            if($form->isSubmitted() && $form->isValid()){
                $entityManagerInterface->persist($newReview);
                $entityManagerInterface->flush();
            }
        }                
        
        return $this->render('pages/index.html.twig', [
            'websiteName' => $websiteName,
            'hours' => $hours,
            'services' => $services,
            'form' => $form,
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }

    #[Route('/services', name: 'app_services')]
    public function services(
        HoursRepository $hoursRepository, 
        ServicesRepository $servicesRepository): Response
    {
        $hours = $hoursRepository->findAll();
        $services = $servicesRepository->findAll();

        return $this->render('pages/services.html.twig', [
            'hours' => $hours,
            'services' => $services,
        ]);
    }
    
    #[Route('/legal', name: 'app_legal')]
    public function legal(
        HoursRepository $hoursRepository, 
        ServicesRepository $servicesRepository): Response
    {
        $hours = $hoursRepository->findAll();
        $services = $servicesRepository->findAll();

        return $this->render('pages/legal.html.twig', [
            'hours' => $hours,
            'services' => $services,
        ]);
    }
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpd(
        HoursRepository $hoursRepository, 
        ServicesRepository $servicesRepository): Response
    {
        $hours = $hoursRepository->findAll();
        $services = $servicesRepository->findAll();

        return $this->render('pages/rgpd.html.twig', [
            'hours' => $hours,
            'services' => $services,
        ]);
    }

}
