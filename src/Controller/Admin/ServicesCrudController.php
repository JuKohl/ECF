<?php

namespace App\Controller\Admin;

use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Services')
        ->setEntityLabelInSingular('service');
    }

    public function configureFields(string $pageName): iterable
    {
        $mappingsParams = $this->getParameter('vich_uploader.mappings');
        $servicesImagePath =  $mappingsParams['services']['uri_prefix'];

        yield TextField::new('type', 'Services');
        yield TextField::new('presentation', 'Présentation');
        yield TextareaField::new('description', 'Description');
        yield TextareaField::new('imageFile', 'Image')->setFormType(VichImageType::class)->hideOnIndex();
        yield ImageField::new('imageName', 'Image')->setBasePath($servicesImagePath)->hideOnForm();
        yield AssociationField::new('user', 'Utilisateur')->hideOnIndex();
    }
}
