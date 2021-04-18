<?php

namespace App\Form;

use App\Entity\UsersCars;
use App\Entity\Users;
use App\Entity\Cars;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UsersCarsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users',EntityType::class,[
                'class' => Users::class,
                'label' => 'user',
                'placeholder' => 'choose your user',        
                'attr' => [
                    'class' => 'form-control'
                ],        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter user'
                    ])
                ]
            ])
            ->add('cars',EntityType::class,[
                'class' => Cars::class,
                'label' => 'car',
                'attr' => [
                    'class' => 'form-control'
                ],        
                'placeholder' => 'choose your car',        
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter car'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UsersCars::class,
        ]);
    }
}
