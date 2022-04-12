<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
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
            ->add('familleAccueil', EntityType::class, [
                // looks for choices from this entity
                'class' => FamilleAccueil::class,
                'choice_label' => 'nom',
                'label' => 'Acceptée par',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false
            ])
            ->add('espece', EntityType::class, [
                // looks for choices from this entity
                'class' => Espece::class,
                'choice_label' => 'type',
                'label' => 'Espèce',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                //'mapped' => false
            ])
            ->add('adoption', EntityType::class, [
                // looks for choices from this entity
                'class' => Adoption::class,
                'choice_label' => 'statut',
                'label' => "Statut d'adoption",
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
