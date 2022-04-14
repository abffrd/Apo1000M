<?php

namespace App\Form;

use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamilleAccueilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
                'attr' => ['placeholder' => 'Pepito'],
                ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'attr' => ['placeholder' => 'Chocolat'],
                ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse :',
                'attr' => ['placeholder' => 'mail@example.com'],
                ])
            ->add('code_postal', IntegerType::class, [
                'label' => 'Code Postal: ',
                'attr' => ['placeholder' => '98764'],
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville :',
                'attr' => ['placeholder' => 'Paris'],
                ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire :',
                'attr' => ['placeholder' => 'Woof? Woof? Bark! Bark!']
                ])
            ->add('email', TextType::class, [
                'label' => 'E-mail :',
                'attr' => ['placeholder' => 'mail@example.com']
                ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone :',
                'attr' => ['placeholder' => '1234567890'],
                ])
            ->add('especes', EntityType::class, [
                // looks for choices from this entity
                'class' => Espece::class,
                'choice_label' => 'type',
                'label' => 'Espèces d\'animaux accueillis :',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FamilleAccueil::class,
        ]);
    }
}
