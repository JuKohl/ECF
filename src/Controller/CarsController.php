<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\CarsRepository;
use App\Repository\HoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\type;

class CarsController extends AbstractController
{
    #[Route('/ventes', name: 'app_cars', methods: ['GET'])]
    public function index(CarsRepository $carsRepository, HoursRepository $hoursRepository, Request $request): Response
    {
        $cars = $carsRepository->findBy([], ['id' => 'DESC']);

        $hours = $hoursRepository->findAll();

        //$search = new PropertySearch();
        //$form = $this->createForm(PropertySearchType::class, $search);
        //$form->handleRequest($request);

        return $this->render('cars/index.html.twig',[ 
            'cars' => $cars,
            'hours' => $hours,
            //'form' => $form->createView(),
        ]);
    }

    #[Route('/cars/{id}', name: 'app_cars_show', methods: ['GET'])]
    public function show(HoursRepository $hoursRepository, Cars $car): Response 
    {
        $hours = $hoursRepository->findAll();

        return $this->render('cars/show.html.twig', [
            'car' => $car,
            'hours' => $hours,
        ]);
    }

}
