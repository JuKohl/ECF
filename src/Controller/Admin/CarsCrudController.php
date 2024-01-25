<?php

namespace App\Controller\Admin;

use App\Entity\Cars;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Date;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cars::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Voitures')
        ->setEntityLabelInSingular('voiture')
        
        ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        $mappingsParams = $this->getParameter('vich_uploader.mappings');
        $carsImagePath =  $mappingsParams['cars']['uri_prefix'];

        yield TextField::new('brand', 'Marque');
        yield TextField::new('model', 'Modèle');
        yield IntegerField::new('price', 'Prix');
        yield IntegerField::new('release_year', 'Année de mise en circulation');
        yield IntegerField::new('mileage', 'Kilométrage');
        yield TextareaField::new('description', 'Description');
        yield TextField::new('technical', 'Carburant');
        yield TextField::new('feature', 'Boite de vitesse');
        yield TextField::new('equipement', 'Equipements');
        yield TextField::new('moreOption', 'Options');
        yield TextareaField::new('imageFile', 'Image')
            ->setFormType(VichImageType::class)
            ->hideOnIndex();
        yield ImageField::new('imageName', 'Image')
            ->setBasePath($carsImagePath)
            ->hideOnForm();
        yield AssociationField::new('user', 'Utilisateur')
            ->hideOnForm()
            ->hideOnIndex();
    }
}
