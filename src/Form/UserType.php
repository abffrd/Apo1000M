<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', EntityType::class, [
                'class'=>Role::class,
                'label' => 'Rôles',
                'choice_label' => 'role',
                'multiple' => true,
                'expanded' => true,
                'mapped' => false
            ] )
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('Actif',ChoiceType::class, [
                'label' => 'Statut du compte',
                'choices'  => [
                    'actif '  => '1',
                    'non actif'  => '0',
                ],
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
