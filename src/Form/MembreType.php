<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Membre;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mot_de_passe')
            ->add('identifiant')
            ->add('actif')
            ->add('roles', EntityType::class, [
                'class'=>Role::class,
                'choice_label' => 'role',
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ])
            ->add('adoptions', EntityType::class, [
                'class'=>Adoption::class,
                'choice_label' => 'adoptant',
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
