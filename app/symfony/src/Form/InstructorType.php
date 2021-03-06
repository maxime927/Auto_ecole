<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstructorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('firstName')
            ->add('password')
            ->add('lastName')
            ->add('birthDate')
            ->add('zipCode')
            ->add('phone')
            ->add('address')
            ->add('registrationNumber')
            ->add('city')
            ->add('qualification')
            ->add('photoFile', FileType::class, [
                'label' => 'Photo',
                'data_class' => null,
                'required' => false
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
