<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Animal;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
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
            /*->add('retour_animaux_proposes', TextareaType::class, [
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
            ])*/
            ->add('remarque', TextareaType::class, [
                'label' => 'Remarques sur le dossier',
                'required' => false,])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut de l\'adoption',
                'required' => false,
                'choices'  => [
                    'à prendre ' => 'à prendre ' ,
                    'CR appel à faire' => 'CR appel à faire',
                    'CR appel à valider' => 'CR appel à valider',
                    'animaux à proposer'  => 'animaux à proposer',
                    'animaux proposés - attente retour adoptant'  => 'animaux proposés - attente retour adoptant',
                    'en attente rencontre'  => 'en attente rencontre',
                    'CR rencontre à valider'  => 'CR rencontre à valider',
                    'en attente visite domicile'  => 'en attente visite domicile',
                    'CR visite à valider'  => 'CR visite à valider',
                    'en attente adoption'  => 'en attente adoption',
                    'en attente départ'  => 'en attente départ',
                    'adoption finalisée'  => 'adoption finalisée',
                    'adoption annulée'  => 'adoption annulée',
                    'dossier sans suite' => 'dossier sans suite',
                ],
                'multiple' => false,
                'expanded' => false,
            ])
            /*->add('animaux_proposes', TextareaType::class, [
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
            ])*/
            ->add('users', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                'label' => 'Bénévoles en charge du dossier',
                'choice_label' => 'fullname',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                'mapped' => true,
                //'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.prenom', 'ASC');
                },
            ])
            ->add('animal', EntityType::class, [
                // looks for choices from this entity
                'class' => Animal::class,
                'choice_label' => 'nom',
                'label' => 'Animal réservé',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                //'mapped' => true,
                //'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.nom', 'ASC');
                },
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoption::class,

            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
