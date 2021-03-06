<?php

namespace App\Form;

use App\Entity\MettingPoint;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MettingPointType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'address',
                EntityType::class,
                [
                    'class' => MettingPoint::class,
                    'label' => 'Choisir Point de rencontre',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('m')
                            ->orderBy('m.address', 'ASC');
                    },
                    'choice_label' => function (MettingPoint $mettingPoint) {
                        return sprintf('%s %s %s', $mettingPoint->getAddress(), $mettingPoint->getCity(), $mettingPoint->getPostalCode());
                    },
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
