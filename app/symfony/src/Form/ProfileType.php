<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\User;
use AppBundle\Entity\ObservationCategoryTree;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProfileType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    private $container;


    /**
     * ProfileType constructor.
     * @param $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locations = $this->entityManager->getRepository(Location::class)->findAll();
        /** @var User $user */
        $user = $this->getUser();
        $disabled = false //!$user->hasRole('ROLE_SUPER_ADMIN')
        ;
        $builder
            ->remove('username')
            ->add('firstName', null, [
                'label' => 'security.login.first_name',
                'disabled' => $disabled,
            ])
            ->add('lastName', null, [
                'label' => 'security.login.last_name',
                'attr' => ['disabled' => $disabled,]
            ])
            ->add('email', null, [
                'label' => 'security.login.email',
                'attr' => ['disabled' => $disabled,]

            ])
            ->add('zipCode', null, [
                'label' => 'security.login.zip_code',
                'attr' => ['disabled' => $disabled,]

            ])
            ->add('phone', null, [
                'label' => 'security.login.phone'
            ])
            ->add('city', null, [
                'label' => 'security.login.city',
                'disabled' => $disabled,

            ])
            ->add('address', null, [
                'label' => 'security.login.address',
                'disabled' => $disabled,

            ])
            ->add('photoFile', FileType::class, [
                'label' => 'Photo',
                'data_class' => null,
                'required' => false
            ]);
        // if ($user->hasRole('ROLE_SUPER_ADMIN')) {
        $builder->remove('current_password');
        // }
    }

    public function getUser()
    {
        return $this->getToken()->getUser();
    }

    /**
     * @return TokenInterface|null
     */
    public function getToken()
    {
        return $this->container->get('security.token_storage')->getToken();
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'fos_user_profile_edit';
    }
}
