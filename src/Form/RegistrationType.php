<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'user.email.label', 'attr' => [
                'placeholder' => 'user.email.placeholder'
            ]])

            ->add('name', TextType::class, ['label' => 'user.name.label', 'attr' => [
                'placeholder' => 'user.name.placeholder'
            ]])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'user.password.invalidMessage',
                'mapped' => false,
                'required' => true,
                'first_options' => ['label' => 'user.password.label', 'attr' => ['placeholder' => 'user.password.placeholder', 'autocomplete' => 'new-password' ]],
                'second_options' => ['label' => 'user.passwordConfirm.label', 'attr' => ['placeholder' => 'user.passwordConfirm.placeholder', 'autocomplete' => 'new-password']],
                'constraints' => [
                    new NotBlank([
                        'message' => 'user.password.notBlank',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'user.password.length',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'user.agreeTerms.label',
                'constraints' => [
                    new IsTrue([
                        'message' => 'user.agreeTerms.message',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
