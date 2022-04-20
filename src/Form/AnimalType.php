<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('date_naissance', DateType::class, [

                'label' => 'Date de naissance :',
                'widget' => 'single_text',
                ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut :',
                'choices' => [
                    'Adoptable' => 'adoptable',
                    'Non adoptable' => 'non adoptable',
                ],
                'multiple' => false,
                'expanded' => false,

                'attr' => ['placeholder' => 'm/f ?'],
                ])
            ->add('tests', TextType::class, [
                'label' => 'Tests :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('sexe', ChoiceType::class, [
                'label' => 'Sexe :',
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',

                ],
                
                'multiple' => false,
                'expanded' => true,
                'mapped' => false,

                'attr' => ['placeholder' => 'm/f ?'],
                ])
            ->add('vaccins', TextType::class, [
                'label' => 'Vaccins :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('photo', TextType::class, [
                'label' => 'Photo :',
                'attr' => ['placeholder' => 'Une photo s\'il vous plait !'],
                ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire :',
                'attr' => ['placeholder' => 'Woof? Woof? Bark! Bark!'],
                ])
            ->add('identification', TextType::class, [
                'label' => 'Identification :',
                'attr' => ['placeholder' => ''],
                ])
            ->add('sterilise', ChoiceType::class, [
                'label' => 'Stérilisé :',
                'choices' => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',

                ],
                'multiple' => false,
                'expanded' => false,
                ])
            ->add('familleAccueil', EntityType::class, [
                // looks for choices from this entity
                'class' => FamilleAccueil::class,
                'choice_label' => 'nom',
                'label' => 'Accueilli par :',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'required' => false,
            ])
            ->add('espece', EntityType::class, [
                // looks for choices from this entity
                'class' => Espece::class,
                'choice_label' => 'type',
                'label' => 'Espèce :',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ]);
            /*->add('adoption', EntityType::class, [
                // looks for choices from this entity
                'class' => Adoption::class,
                'choice_label' => 'statut',
                'label' => "Statut d'adoption",
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ]);*/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
