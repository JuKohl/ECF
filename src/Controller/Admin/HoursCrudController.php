<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Hours;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HoursCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Hours::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Horaires')
        ->setEntityLabelInSingular('horaire');
    }

    public function configureFields(string $pageName): iterable
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();
        $userChoices = [];
        foreach ($users as $user) {
            $fullName = $user->getFirstName() . ' ' . $user->getName();
            $userChoices[$fullName] = $user;
        }

        yield TextField::new('day', 'Jour');
        yield TextField::new('hour', 'Horaires');
        yield ChoiceField::new('user', 'Utilisateur')
            ->hideOnIndex()
            ->setChoices($userChoices);
    }
}
