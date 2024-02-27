<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\CarsRepository;
use App\Repository\HoursRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\type;

class CarsController extends AbstractController
{
    #[Route('/ventes', name: 'app_cars')]
    public function index(
        CarsRepository $carsRepository, 
        HoursRepository $hoursRepository, 
        Request $request,
        PaginatorInterface $paginator): Response
    {
        $hours = $hoursRepository->findAll();
        
        $cars = $carsRepository->findBy([], ['id' => 'DESC']);
        $cars = $paginator->paginate(
            $carsRepository->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            3
        );

        $minMaxValues = [
            'minMileage' => $carsRepository->findMinMaxMileage()['minMileage'],
            'maxMileage' => $carsRepository->findMinMaxMileage()['maxMileage'],
            'minReleaseYear' => $carsRepository->findMinMaxReleaseYear()['minReleaseYear'],
            'maxReleaseYear' => $carsRepository->findMinMaxReleaseYear()['maxReleaseYear'],
            'minPrice' => $carsRepository->findMinMaxPrice()['minPrice'],
            'maxPrice' => $carsRepository->findMinMaxPrice()['maxPrice'],
        ];

        return $this->render('pages/cars/cars.html.twig',[ 
            'cars' => $cars,
            'hours' => $hours,
            'minMaxValues' => $minMaxValues,
        ]);    
    }    

    #[Route('/cars/{id}', name: 'app_cars_show')]
    public function show(
        HoursRepository $hoursRepository, 
        Cars $car): Response 
    {
        $hours = $hoursRepository->findAll();

        $carImages = $car->getCarsImages();

        return $this->render('pages/cars/show.html.twig', [
            'car' => $car,
            'hours' => $hours,
            'carImages' => $carImages,
        ]);
    }

}
