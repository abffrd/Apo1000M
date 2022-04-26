<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Adoptant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('start')
            ->add('end')
            ->add('backgroundColor')
            ->add('textColor')
            ->add('allDay')
            ->add('adoptant',EntityType::class, [
                
                'class' => Adoptant::class,
                'choice_label' => 'nom',
                'label' => 'Adoptant',
                'expanded' => true,
                'mapped' => true,
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
