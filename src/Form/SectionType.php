<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contentFr', TextareaType::class, ['label' => 'Texte en français', 'attr' => [
                'placeholder' => 'Entrez le contenu en français'
            ]])
            ->add('contentNl', TextareaType::class, ['label' => 'Texte en néerlandais',
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
        ]);
    }
}
