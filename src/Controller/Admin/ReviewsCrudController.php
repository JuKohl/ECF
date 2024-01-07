<?php

namespace App\Controller\Admin;

use App\Entity\Reviews;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReviewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reviews::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Avis')
        ->setEntityLabelInSingular('avis');
    }

    public function configureFields(string $pageName): iterable
    {
        // yield from parent::configureFields($pageName);
        yield TextField::new('review', 'Avis')
        ->setFormTypeOption('disabled', 'disabled');
        yield BooleanField::new('approved', 'Approuvée');
        yield TextField::new('name', 'Identité')
            ->setFormTypeOption('disabled', 'disabled');
        yield ChoiceField::new('rate', 'Notes')->setChoices([
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
        ])->renderExpanded()            
        ->setFormTypeOption('disabled', 'disabled');
        yield AssociationField::new('user', 'Utilisateur')->hideOnIndex();
    }
    
}
