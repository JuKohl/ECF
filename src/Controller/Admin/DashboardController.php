<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use App\Entity\User;
use App\Entity\Hours;
use App\Entity\Contact;
use App\Entity\Reviews;
use App\Entity\Services;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V. Parrot - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Horaires', 'fa-regular fa-clock', Hours::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-wrench', Services::class);
        yield MenuItem::linkToCrud('Voitures', 'fas fa-car-side', Cars::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-star', Reviews::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::linkToCrud('Demandes de contact', 'fa-solid fa-envelope', Contact::class);
    }
}
