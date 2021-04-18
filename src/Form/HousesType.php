<?php

namespace App\Form;

use App\Entity\Houses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class HousesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your adresse'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your adresse'
                    ])
                ]
            ])
            ->add('postalCode',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your postal code'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your postal code'
                    ])
                ]
            ])
            ->add('city',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your city'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your city'
                    ])
                ]
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your country'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your country'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Houses::class,
        ]);
    }
}
