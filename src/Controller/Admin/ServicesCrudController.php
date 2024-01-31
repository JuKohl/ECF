<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServicesCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Services')
        ->setEntityLabelInSingular('service')
        
        ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        $mappingsParams = $this->getParameter('vich_uploader.mappings');
        $servicesImagePath =  $mappingsParams['services']['uri_prefix'];

        $userRepository = $this->entityManager->getRepository(User::class);
        $users = $userRepository->findAll();
        $userChoices = [];
        foreach ($users as $user) {
            $fullName = $user->getFirstName() . ' ' . $user->getName();
            $userChoices[$fullName] = $user;
        }

        yield TextField::new('type', 'Services');
        yield TextField::new('presentation', 'Présentation');
        yield TextareaField::new('description', 'Description');
        yield TextareaField::new('imageFile', 'Image')
            ->setFormType(VichImageType::class)
            ->hideOnIndex();
        yield ImageField::new('imageName', 'Image')
            ->setBasePath($servicesImagePath)
            ->hideOnForm();
        yield AssociationField::new('user', 'Utilisateur')
            ->formatValue(function ($value, $entity){
                return $entity->getUser()->getFirstName() . ' ' . $entity->getUser()->getName();
            })
            ->setFormTypeOptions([
                'choices' => $userChoices,
                'choice_label' => function ($user) {
                    return $user->getFirstName() . ' ' . $user->getName();
                }
            ]);
    }
}
