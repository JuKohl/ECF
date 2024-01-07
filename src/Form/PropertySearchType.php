<?php

namespace App\Form;

use App\Entity\PropertySearch;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minMileage', IntegerField::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Kilométrage'
                    ]
            ])
            ->add('maxMileage', IntegerField::class, [
                'required' => false,
                'label' => false
            ])
            ->add('minReleaseYear', IntegerField::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Année'
                    ]
            ])
            ->add('maxReleaseYear', IntegerField::class, [
                'required' => false,
                'label' => false
            ])
            ->add('minPrice', IntegerField::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix'
                    ]
            ])
            ->add('maxPrice', IntegerField::class, [
                'required' => false,
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
