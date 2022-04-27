<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\Form\Type\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',

            ])
            ->add('approles', EntityType::class, [
                'class'=>Role::class,
                'label' => 'Rôles :',
                'choice_label' => 'role',
                'multiple' => true,
                'expanded' => true,
               
            ])
            ->add('password', )
            //,[
            //     'label' => 'Mot de passe :',
            //     'always_empty' => false,
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Veuillez saisir un mot de passe',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'votre mot de passe doit faire au moins {{ limit }} caractères',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])
            ->add('nom', TextType::class,[
                'label' => 'Nom :',
                
            ])

            ->add('prenom', TextType::class,[
                'label' => 'Prénom :',

            ])
            ->add('Actif',ChoiceType::class, [
                'label' => 'Statut du compte :',
                'choices'  => [
                    'actif '  => '1',
                    'non actif'  => '0',
                ],
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => ['novalidate' => 'novalidate']
        ]);
    }
}
