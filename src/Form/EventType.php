<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleFr', TextType::class, [ 'label' => 'Titre', 
                'attr' => [
                    'placeholder' => 'Entrez le titre de l\'évenement', 
                ]
            ])
            /*->add('titleNl')
            ->add('titleEn')*/
            ->add('resumeFr', TextareaType::class, ['label' => 'Résumé', 
                'attr' => [
                    'placeholder' => 'Entrez une briève description de l\'évenement', 
                    'rows' => '3'
                ]
            ])
            /*->add('resumeNl')
            ->add('resumeEn')*/
            ->add('descriptionFr', TextareaType::class, ['label' => 'Description', 
                'attr' => [
                    'placeholder' => 'Entrez la description de l\'évenement', 
                    'rows' => '8'
                ]
            ])
            /*->add('descriptionNl')
            ->add('descriptionEn')*/
            ->add('dateTimeStart', DateTimeType::class, [
                'date_label' => 'Commence le',
            ])
            ->add('dateTimeEnd', DateTimeType::class, [
                'date_label' => 'Fini le',
            ])
            ->add('address', TextareaType::class, [ 'label' => 'Adresse (complète)', 
                'attr' => [
                    'placeholder' => 'Entrez l\'adresse complète de l\'évenement', 
                    'rows' => '4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
