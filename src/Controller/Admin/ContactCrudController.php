<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
        ->setEntityLabelInPlural('Demandes de contact')
        ->setEntityLabelInSingular('demande de contact')

        ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('name', 'Nom')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('firstName', 'Prénom')
                ->setFormTypeOption('disabled', 'disabled'),
            EmailField::new('email')
                ->setFormTypeOption('disabled', 'disabled'),
            NumberField::new('phoneNumber', 'Numéro de téléphone')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('subject', 'Objet')
                ->setFormTypeOption('disabled', 'disabled'),
            TextareaField::new('message', 'Message')
                ->setFormTypeOption('disabled', 'disabled')
                ->hideOnIndex(),
            DateTimeField::new('createdAt', 'Date de la demande')
                ->hideOnForm(),
        ];
    }
}
