<?php

namespace App\Form;

use App\Entity\Adoptant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AdoptantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
            'label' => 'Nom :',
             'required' => false,
             'attr' => ['placeholder' => 'Poti'],
             ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'required' => false,
                'attr' => ['placeholder' => 'Poutchi'],
                ])
            ->add('adresse', TextType::class,[
                'label' => 'Adresse :',
                'required' => false,
                'attr' => ['placeholder' => '00 avenue des petites patates'],
                ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone :',
                'attr' => ['placeholder' => '1234567890'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',
                'required' => false,
                'attr' => ['placeholder' => 'mail@example.com'],
                ])
            ->add('ville', TextType::class, [
                'label' => 'Ville :',
                'attr' => ['placeholder' => 'Paris'],
                'required' => false,
            ])
            ->add('code_postal', IntegerType::class, [
                'label' => 'Code Postal : ',
                'attr' => ['placeholder' => '98745'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoptant::class,
        ]);
    }
}
