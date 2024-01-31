<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Reviews;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ReviewsCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Reviews::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Avis')
        ->setEntityLabelInSingular('avis')
        
        ->setPaginatorPageSize(10);
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
        // yield from parent::configureFields($pageName);
        yield TextField::new('review', 'Avis')
            ->setFormTypeOption('disabled', 'disabled');
        yield BooleanField::new('approved', 'Approuvée');
        yield ChoiceField::new('rate', 'Notes')
            ->setChoices([
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
        ])
            ->renderExpanded()            
            ->setFormTypeOption('disabled', 'disabled');
        yield DateTimeField::new('createdAt', 'Date de l\'avis')
            ->setFormTypeOption('disabled', 'disabled');
        yield AssociationField::new('user', 'Utilisateur')
            ->formatValue(function ($value, $entity){
                return $entity->getUser()->getFirstName() . ' ' . $entity->getUser()->getName();
            })
            ->setFormTypeOptions([
                'choices' => $userChoices,
                'choice_label' => function ($user) {
                    return $user->getFirstName() . ' ' . $user->getName();
                }
            ])
            ->setFormTypeOption('disabled', 'disabled');
    }
    
}
