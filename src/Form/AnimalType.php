<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'attr' => ['placeholder' => 'Pepito'],
                ])
            ->add('date_naissance', TextType::class, [
                'label' => 'Date de naissance :',
                'attr' => ['placeholder' => 'Cacao'],
                ])
            ->add('statut', TextType::class, [
                'label' => 'Statut :',
                'attr' => ['placeholder' => 'Disponible ? '],
                ])
            ->add('tests', TextType::class, [
                'label' => 'Tests :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('sexe', TextType::class, [
                'label' => 'Sexe :',
                'attr' => ['placeholder' => 'M/F ?'],
                ])
            ->add('vaccins', TextType::class, [
                'label' => 'Vaccins :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('photo', TextType::class, [
                'label' => 'Photo :',
                'attr' => ['placeholder' => 'Une photo s\'il vous plait !'],
                ])
            ->add('commentaire', TextType::class, [
                'label' => 'Commentaire :',
                'attr' => ['placeholder' => 'Woof? Woof? Bark! Bark!'],
                ])
            ->add('identification', TextType::class, [
                'label' => 'Identification :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('sterilise', TextType::class, [
                'label' => 'Stérilisé :',
                'attr' => ['placeholder' => ''],
                ])
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
                'mapped' => false
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
