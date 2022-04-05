<?php

namespace App\Form;

use App\Entity\Adoption;
use App\Entity\Membre;
use App\Entity\Role;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'])
            ->add('mot_de_passe', PasswordType::class)
            ->add('identifiant', TextType::class, [
                'label' => 'E-mail',
                'attr' => ['placeholder' => 'mail@example.com'],
            ])
            ->add('actif', CheckboxType::class)
            ->add('roles', EntityType::class, [
                'class'=>Role::class,
                'label' => 'Rôles',
                'choice_label' => 'role',
                'multiple' => true,
                'expanded' => true,
                'mapped' => false,
            ])


            //le lien adoption-membre sera modifié depuis le formulaire adoption

            /* ->add('adoptions', EntityType::class, [
                'class'=>Adoption::class,
                'choice_label' => 'id',
                'multiple' => true,
                'expanded' => false,
                'mapped' => false,
            ]) */;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
