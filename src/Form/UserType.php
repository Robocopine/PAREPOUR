<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom Complet', 'attr' => [
                'placeholder' => 'Entrez un prénom + nom'
            ]])
            ->add('email', EmailType::class, ['label' => 'Email', 'attr' => [
                'placeholder' => 'Entrez une adresse email'
            ]])
            ->add('title', TextType::class, ['label' => 'Email', 'attr' => [
                'placeholder' => 'Entrez une adresse email'
            ]])
            /* ->add('avatar', FileType::class, [
             *   'label' => 'Avatar (jpg, png)',
             *   'attr' => ['placeholder' => 'Téléchargez votre avatar'],
             *
             *   // unmapped means that this field is not associated to any entity property
             *   'mapped' => false,
             *
             *   // make it optional so you don't have to re-upload the PDF file
             *   // everytime you edit the Product details
             *   'required' => false,
             *
             *   // unmapped fields can't define their validation using annotations
             *   // in the associated entity, so you can use the PHP constraint classes
             *  'constraints' => [
             *       new File([
             *           'maxSize' => '1024k',
             *           'mimeTypes' => [
             *              'image/jpeg',
             *              'image/png',
             *           ],
             *           'mimeTypesMessage' => 'Le fichier doit être au format jpg, jpeg ou png',
             *       ])
             *   ],
             *])
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
