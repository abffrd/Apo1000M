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
                'label' => 'Nom'])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'])
            ->add('code_postal', IntegerType::class)
            ->add('ville', TextType::class, [
                'label' => 'Ville'])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaire'])
            ->add('email')
            ->add('telephone', TextType::class)
            ->add('especes', EntityType::class, [
                // looks for choices from this entity
                'class' => Espece::class,
                'choice_label' => 'type',
                'label' => 'Espèces d\'animaux accueillis',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                'mapped' => false
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
