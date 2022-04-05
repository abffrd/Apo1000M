<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Animal1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('date_naissance')
            ->add('statut')
            ->add('tests')
            ->add('sexe')
            ->add('vaccins')
            ->add('photo')
            ->add('commentaire')
            ->add('identification')
            ->add('sterilise')
            ->add('familleAccueil')
            ->add('espece')
            ->add('adoption')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
