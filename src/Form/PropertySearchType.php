<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minMileage', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Kilométrage'
                    ]
            ])
            ->add('maxMileage', IntegerType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('minReleaseYear', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Année'
                    ]
            ])
            ->add('maxReleaseYear', IntegerType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('minPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prix'
                    ]
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false
            ])
            ->add ('submit', SubmitType::class, [
                'label' => 'Filter',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }
}
