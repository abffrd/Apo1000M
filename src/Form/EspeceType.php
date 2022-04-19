<?php

namespace App\Form;

use App\Entity\Espece;
use App\Entity\FamilleAccueil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EspeceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',TextType::class, [

                'label' => 'Type de l\'animal :',
                'attr' => ['placeholder' => 'ex: Chien'],
                ]);
            // ->add('familleAccueils', EntityType::class, [
            //     // looks for choices from this entity
            //     'class' => FamilleAccueil::class,
            //     'choice_label' => 'nom',
            //     'label' => 'Acceptée par',
            //     // used to render a select box, check boxes or radios
            //     'multiple' => false,
            //     'expanded' => false,

            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Espece::class,
        ]);
    }
}
