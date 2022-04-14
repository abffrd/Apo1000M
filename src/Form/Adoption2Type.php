<?php

namespace App\Form;

use App\Entity\Adoption;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Adoption2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_appel')
            ->add('compte_rendu')
            ->add('retour_animaux_proposes')
            ->add('date_rencontre')
            ->add('retour_rencontre_adoptant')
            ->add('retour_rencontre_fa')
            ->add('date_visite')
            ->add('retour_visite')
            ->add('date_adoption')
            ->add('date_depart')
            ->add('remarque')
            ->add('statut')
            ->add('animaux_proposes')
            ->add('adoptant')
            ->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoption::class,
        ]);
    }
}
