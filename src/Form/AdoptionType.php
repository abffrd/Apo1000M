<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Adoptant;
use App\Entity\Animal;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_appel', DateType::class, [
                'label' => 'Date d\'appel',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
                'data' => new \DateTimeImmutable(),
            ])
            ->add('compte_rendu', TextareaType::class, [
                'label' => 'Compte-rendu de l\'appel',
                'required' => false,])
            ->add('retour_animaux_proposes', TextareaType::class, [
                'label' => 'Retour de l\adoptant sur les animaux proposés',
                'required' => false,])
            ->add('date_rencontre', DateType::class, [
                'label' => 'Date de rencontre entre l\'adoptant et l\'animal',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
                'data' => new \DateTimeImmutable(),
            ])
            ->add('retour_rencontre_adoptant', TextareaType::class, [
                'label' => 'Retour de l\adoptant sur la rencontre de l\'animal',
                'required' => false,])
            ->add('retour_rencontre_fa', TextareaType::class, [
                'label' => 'Retour de la FA sur la rencontre de l\'animal',
                'required' => false,])
            ->add('date_visite', DateType::class, [
                'label' => 'Date de visite du domicile de l\'adoptant',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
                'data' => new \DateTimeImmutable(),
            ])
            ->add('retour_visite', TextareaType::class, [
                'label' => 'Retour du bénévole sur la visite du domicile',
                'required' => false,])
            ->add('date_adoption', DateType::class, [
                'label' => 'Date d\'adoption',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
                'data' => new \DateTimeImmutable(),
            ])
            ->add('date_depart', DateType::class, [
                'label' => 'Date de départ',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'required' => false,
                'data' => new \DateTimeImmutable(),
            ])
            ->add('remarque', TextareaType::class, [
                'label' => 'Remarques sur le dossier',
                'required' => false,])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut de l\'adoption',
                'required' => false,
                'choices'  => [
                    'à prendre '  => '000',
                    'CR appel à faire'  => '010',
                    'CR appel à valider'  => '020',
                    'animaux à proposer'  => '030',
                    'animaux proposés - attente retour adoptant'  => '040',
                    'en attente rencontre'  => '050',
                    'CR rencontre à valider'  => '060',
                    'en attente visite domicile'  => '070',
                    'CR visite à valider'  => '080',
                    'en attente adoption'  => '090',
                    'en attente départ'  => '100',
                    'adoption finalisée'  => '110',
                    'adoption annulée'  => '999',
                ],
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('animaux_proposes', TextareaType::class, [
                'label' => 'Animaux proposés',
                'required' => false,])
            ->add('adoptant', EntityType::class, [
                // looks for choices from this entity
                'class' => Adoptant::class,
                'choice_label' => 'fullname',
                'label' => 'Adoptant',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'required' => false,
            ])
            ->add('users', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                'label' => 'Bénévoles en charge du dossier',
                'choice_label' => 'fullname',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => false,
               
                'required' => false,
            ])
            ->add('animals', EntityType::class, [
                // looks for choices from this entity
                'class' => Animal::class,
                'choice_label' => 'nom',
                'label' => 'Animal réservé',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
                'mapped' => false,
                'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoption::class,
        ]);
    }
}
