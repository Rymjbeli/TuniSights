<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotNull;

class EditProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('Image', FileType::class, [
                'label' => 'Choose an image',
                'mapped' => false,
                'required' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Image',
                    ]),
                    new NotNull([
                        'groups' => ['edit'],
                    ])
                ],

            ])
            ->add('bio')
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender',
                'choices' => [
                    'Male' => 'M',
                    'Female' => 'F',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'options',
                ],
                'row_attr' => [
                    'class' => 'gender-row',
                ],
            ])
            ->add('dateOfBirth', BirthdayType::class, [
                'label' => 'Date of Birth',
                'format' => 'yyyy-MM-dd',
                'years' => range(date('Y') - 100, date('Y') - 13),
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}