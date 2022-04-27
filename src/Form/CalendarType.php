<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Adoptant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class)
            ->add('description',TextType::class)
            ->add('start', DateTimeType::class, [

                'label' => 'RDV Commence à :',
                'widget' => 'single_text',
                ])
            ->add('end',DateTimeType::class, [
                'required'=> false,
                'label' => 'RDV jusqu\'au :',
                'widget' => 'single_text',
                ])
            ->add('backgroundColor',ColorType::class)
            ->add('textColor',ColorType::class)
            ->add('allDay',checkboxType::class ,[
                'required'=> false,
               
                ])
            ->add('adoptant',EntityType::class, [
                
                'class' => Adoptant::class,
                'choice_label' => 'nom',
                'label' => 'Adoptant',
                'multiple' => false,
                'expanded' => false,
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
