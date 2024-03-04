<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\CarsRepository;
use App\Repository\HoursRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $minMaxValues = [
            'minMileage' => $carsRepository->findMinMaxMileage()['minMileage'],
            'maxMileage' => $carsRepository->findMinMaxMileage()['maxMileage'],
            'minReleaseYear' => $carsRepository->findMinMaxReleaseYear()['minReleaseYear'],
            'maxReleaseYear' => $carsRepository->findMinMaxReleaseYear()['maxReleaseYear'],
            'minPrice' => $carsRepository->findMinMaxPrice()['minPrice'],
            'maxPrice' => $carsRepository->findMinMaxPrice()['maxPrice'],
        ];

        $hours = $hoursRepository->findAll();
        
        $cars = $paginator->paginate(
            $carsRepository->findBy([], ['id' => 'DESC']),
            $request->query->getInt('page', 1),
            3
        );
                
        return $this->render('pages/cars/cars.html.twig',[ 
            'cars' => $cars,
            'hours' => $hours,
            'minMaxValues' => $minMaxValues,
        ]);    
    }  

    #[Route('/filter', name: 'app_filterCars')]
    public function filter (
        Request $request,
        CarsRepository $carsRepository): JsonResponse
        {
            $minMaxValues = [
                'minMileage' => $carsRepository->findMinMaxMileage()['minMileage'],
                'maxMileage' => $carsRepository->findMinMaxMileage()['maxMileage'],
                'minReleaseYear' => $carsRepository->findMinMaxReleaseYear()['minReleaseYear'],
                'maxReleaseYear' => $carsRepository->findMinMaxReleaseYear()['maxReleaseYear'],
                'minPrice' => $carsRepository->findMinMaxPrice()['minPrice'],
                'maxPrice' => $carsRepository->findMinMaxPrice()['maxPrice'],
            ];
    
            $minMileage = $request->query->get('minMileage');
            $maxMileage = $request->query->get('maxMileage');
            $minReleaseYear = $request->query->get('minReleaseYear');
            $maxReleaseYear = $request->query->get('maxReleaseYear');
            $minPrice = $request->query->get('minPrice');
            $maxPrice = $request->query->get('maxPrice');
    
            $filteredCars = $carsRepository->FindFilteredCars($minMileage, $maxMileage, $minReleaseYear, $maxReleaseYear, $minPrice, $maxPrice);

            return new JsonResponse([
                'content' => $this->renderView('pages/cars/_filterCars.html.twig', 
                ['cars' => $filteredCars,
                'minMaxValues' => $minMaxValues,
            ]),
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
