<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre en anglais', 'attr' => [
                'placeholder' => 'Entrez le titre en anglais', 'id' => "titleSectionForm"
            ]]) 
            ->add('contentFr', TextareaType::class, ['label' => 'Contenu', 
                'attr' => [
                    'placeholder' => 'Entrez le contenu de la section', 
                    'rows' => '8'
                ]
            ])
            /* ->add('contentNl', TextareaType::class, ['label' => 'Texte en néerlandais',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez le contenu en néerlandais'
                ]
            ])
            ->add('contentEn', TextareaType::class, ['label' => 'Texte en anglais', 
                'required' => false,
                'attr' => [ 
                    'placeholder' => 'Entrez le contenu en anglais'
                ]
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
