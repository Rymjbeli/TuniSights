<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [

                'label' => false,
                'attr' => [
                    'placeholder' => 'Username',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',

                ],
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'label' => false,
                'format' => 'yyyy-MM-dd',
                'years' => range(date('Y') - 100, date('Y') - 13),
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['autocomplete' => 'new-password']],
                'required' => true,
                'first_options' => ['label' => false,
                    'attr' => [
                        'class' => 'password',
                        'placeholder' => 'Password',
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                            'message' => 'Your password must be at least 6 characters long and contain digits, uppercase and lowercase letters',
                            ]),
                    ],],
                'second_options' => ['label' => false,
                    'attr' => [
                        'class' => 'password',
                        'placeholder' => 'Confirm Password',
                    ]],
                'mapped' => false,

            ])
            ->add('gender', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Male' => 'M',
                    'Female' => 'F',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'options',
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
