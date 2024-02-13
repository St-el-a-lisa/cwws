<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => "Nom d'utilisateur",
                'attr' => ['class' => 'form-control', 'placeholder' => 'Coffee_addict']
            ])
            ->add('email', EmailType::class, [
                'label' => "Votre Email",
                'attr' => ['class' => 'form-control', 'placeholder' => 'coffee@coffee.com']
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['label' => 'Mot de passe', 'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Un mot de passe fort en coffee : 8 caractères, 1 majuscule, 1 minuscule, 1 caractère spécial et 1 nombre.']],
                'second_options' => ['label' => 'Confirmez le mot de passe', 'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Pas 123456!']],
                'invalid_message' => 'Les deux mots de passe doivent correspondre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe ',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit comporter {{ limit }} caractères minimum.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/',
                        'message' => 'Votre mot de passe doit être composé d\'au moins une majuscule, une minuscule, un chiffre et un caractère spécial(&!%$...).',
                    ]),
                ],
            ])
            ->add('Consent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Merci pour votre consentement.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
