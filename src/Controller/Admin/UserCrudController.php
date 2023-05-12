<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ChoiceField,
    IdField,
    ImageField,
    TextField,
    AssociationField,
    BooleanField,
    DateField};
use EasyCorp\Bundle\EasyAdminBundle\Config\{Actions, Action, KeyValueStore};
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType, PasswordType, RepeatedType};
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use Symfony\Component\Form\{FormBuilderInterface, FormEvents};
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Vich\UploaderBundle\Form\Type\VichImageType;


#[
    IsGranted("ROLE_ADMIN")
]
class UserCrudController extends AbstractCrudController
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();

        yield ImageField::new('Image')
            ->setValue('avatar.png')
            ->hideWhenCreating()
            ->setBasePath('/assets/Images')
            ->hideOnIndex();
        yield TextField::new('ImageFile')
            ->hideOnDetail()
            ->hideOnIndex()
            ->hideWhenCreating()
            ->setFormType(VichImageType::class);

        yield TextField::new('username');
        yield TextField::new('email');
        yield TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password',
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
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])

            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms();
        yield DateField::new('dateOfBirth');
        yield TextField::new('gender')->hideOnForm();
        yield AssociationField::new('posts')->hideOnForm();
        yield BooleanField::new('isVerified')
            ->setLabel('Is Verified')
            ->setFormTypeOption('data', true);
        yield ChoiceField::new('gender')
            ->hideOnIndex()
            ->setChoices(['Male' => 'M', 'Female' => 'F'])
            ->setRequired(true);
        $defaultRole = 'ROLE_ADMIN';

        yield ChoiceField::new('roles')
            ->hideOnIndex()
            ->setChoices([$defaultRole => $defaultRole])
            ->allowMultipleChoices()
            ->setValue([$defaultRole])
            ->setRequired(true)
            ->setFormType(ChoiceType::class);


    }

    public function configureCrud(Crud $crud): Crud
    {
        return parent::configureCrud($crud)
            ->setEntityLabelInSingular('Admin')
            ->setPageTitle(Crud::PAGE_INDEX, 'Users');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->setIcon('fa fa-user-plus')
                    ->setLabel('Add Admin'); // Change the label to "Add Admin"
            });
    }

    /*Hash password before persisting to database*/
    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    private function hashPassword()
    {
        return function ($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword($form->getData(), $password);
            $form->getData()->setPassword($hash);
        };

    }

}
