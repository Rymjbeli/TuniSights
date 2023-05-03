<?php

namespace App\Form;

use App\Entity\Post;
use App\Service\UploaderService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class AddPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                    'label' => 'Give your article an eye-catching title',
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a description'
                    ])
                ],
                'attr' => [
                    'class' => 'form-control'

                ]
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    '-- Select a category --' => '',
                    'Cafe' => 'cafe',
                    'Restaurant' => 'restau',
                    'Parc' => 'parc',
                    'Museum' => 'museum',
                    'Monument' => 'monument',
                    'Beach' => 'beach',
                    'Natural vue' => 'natural view',
                    'Other' => 'other',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a category'
                    ])
                ],
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('state', ChoiceType::class, [
                'choices' => [
                    '-- Select a state --' => '',
                    'Ariana' => 'Ariana',
                    'Beja' => 'Beja',
                    'Ben Arous' => 'Ben Arous',
                    'Bizerte' => 'Bizerte',
                    'Gabes' => 'Gabes',
                    'Gafsa' => 'Gafsa',
                    'Jendouba' => 'Jendouba',
                    'Kairouan' => 'Kairouan',
                    'Kasserine' => 'Kasserine',
                    'Kebili' => 'Kebili',
                    'Kef' => 'Kef',
                    'Mahdia' => 'Mahdia',
                    'Manouba' => 'Manouba',
                    'Medenine' => 'Medenine',
                    'Monastir' => 'Monastir',
                    'Nabeul' => 'Nabeul',
                    'Sfax' => 'Sfax',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Siliana' => 'Siliana',
                    'Sousse' => 'Sousse',
                    'Tataouine' => 'Tataouine',
                    'Tozeur' => 'Tozeur',
                    'Tunis' => 'Tunis',
                    'Zaghouan' => 'Zaghouan',

                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please select a state'
                    ])
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ]
            ])
            ->add('city', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a city '
                    ])
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('place', null, [

                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('Image', FileType::class, [
                'label' => 'Choose an image',
                'mapped' => true,
                'required' => true,
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
                        'message' => 'Please choose an image to upload',
                    ]),
                ],

            ])
            ->add('location', null, [
                'attr' => [
                    'class' => 'form-control',
                ]])
            ->add('rating', ChoiceType::class, [
                'choices' => [
                    '5 stars' => 5,
                    '4 stars' => 4,
                    '3 stars' => 3,
                    '2 stars' => 2,
                    '1 star' => 1,
                ],
                'expanded' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please provide a rating for your trip'
                    ])
                ],
                'label' => 'Rate your trip',
                'attr' => [
                    'class' => 'rate',
                ],

            ])
            ->add('Submit', SubmitType::class)
            ->add('Reset', ResetType::class, [
                'attr' => ['class' => 'Reset'],
            ])
            ->add('cancel', ResetType::class, [
                'label' => 'Cancel',
                'attr' => [
                    'class' => 'btn btn-secondary',
                    'onclick' => 'location.href = "/index";',
                ],
            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
