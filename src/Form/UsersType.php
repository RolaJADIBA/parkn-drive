<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Houses;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your name'
                ],  
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name'
                    ])
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your first name'
                ],     
                // 'placeholder' => 'add your first firstname',        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your firstname'
                    ])
                ]
            ])
            ->add('email',EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your email'
                ],      
                // 'placeholder' => 'add your first email',        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your email'
                    ])
                ]
            ])
            ->add('password',PasswordType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'add your password'
                ],  
                // 'placeholder' => 'add your password',             
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your password'
                    ])
                ]
            ])
            ->add('houses',EntityType::class,[
                'class' => Houses::class,
                // 'label' => 'houses',
                'multiple' =>true,
                'attr' => [
                    'class' => 'form-control'
                ],        
                // 'placeholder' => 'choose your house',        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter house'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
