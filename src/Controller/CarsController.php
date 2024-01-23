<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\CarsRepository;
use App\Repository\HoursRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

        return $this->render('pages/cars/cars.html.twig',[ 
            'cars' => $cars,
            'hours' => $hours,
        ]);
    }

    // public function propertySearchType(
    //     Request $request, 
    //     CarsRepository $carsRepository, 
    //     PaginatorInterface $paginator): Response
    // {
    //     $filterData = new PropertySearch();

    //     $form = $this->createForm(PropertySearchType::class, $filterData);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $filterData = $form->getData();

    //         $minMileage = $filterData->getMinMileage();
    //         $maxMileage = $filterData->getMaxMileage();
    //         $minReleaseYear = $filterData->getMinReleaseYear();
    //         $maxReleaseYear = $filterData->getMaxReleaseYear();
    //         $minPrice = $filterData->getMinPrice();
    //         $maxPrice = $filterData->getMaxPrice();

    //         $filteredForm = $carsRepository->findByFilters($minMileage,$maxMileage,$minReleaseYear,$maxReleaseYear,$minPrice,$maxPrice);

    //         // $cars = $paginator->paginate(
    //         //     $filteredCars,
    //         //     $request->query->getInt('page', 1),
    //         //     3
    //         // );
    
    //         return $this->render('pages/cars/cars.html.twig', [
    //             'form' => $form->createView(),
    //             'filteredForm'=> $filteredForm->createView(),
    //         ]);
    //     }
    //         // return $this->render('cars/index.html.twig', [
    //         // 'form' => $form->createView(),
    //     // ]);
    // }

    #[Route('/cars/{id}', name: 'app_cars_show')]
    public function show(
        HoursRepository $hoursRepository, 
        Cars $car): Response 
    {
        $hours = $hoursRepository->findAll();

        return $this->render('pages/cars/show.html.twig', [
            'car' => $car,
            'hours' => $hours,
        ]);
    }

}
