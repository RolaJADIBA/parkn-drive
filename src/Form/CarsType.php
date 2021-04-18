<?php

namespace App\Form;

use App\Entity\Cars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mark', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your mark'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your mark'
                    ])
                ]
            ])
            ->add('model', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your model'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your model'
                    ])
                ]
            ])
            ->add('image', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],        
                'required' => false,
                'data_class' => null
            ])
            ->add('gearBox', ChoiceType::class, [
                'choices' => [
                    'auto' => 'auto',
                    'manuel' => 'manuel'
                ],
                'attr' => [
                    'class' => 'form-control',
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name'
                    ])
                ]
            ])
            ->add('mileage', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your mileage'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your mileage'
                    ])
                ]
            ])
            ->add('prodctionDate', DateType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your prodction Date'
                    ])
                ]
            ])
            // ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cars::class,
        ]);
    }
}
