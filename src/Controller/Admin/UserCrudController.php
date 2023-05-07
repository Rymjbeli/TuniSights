<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('username');
        yield TextField::new('email');
        yield TextField::new('password')->onlyOnForms();
        yield DateField::new('dateOfBirth');
        yield TextField::new('gender')->hideOnForm();
        yield AssociationField::new('posts')->hideOnForm();
        yield BooleanField::new('isVerified');
        yield ChoiceField::new('gender')
            ->hideOnIndex()
            ->setChoices(['Male' => 'M', 'Female' => 'F'])
            ->setFormType(ChoiceType::class)
            ->setFormTypeOptions([
                'multiple' => false,
                'expanded' => false,
                'choice_translation_domain' => false,
                'attr' => ['class' => 'radio-inline'],
            ]);
        $defaultRole = 'ROLE_ADMIN';

        yield ChoiceField::new('roles')
            ->hideOnIndex()
            ->setChoices([$defaultRole => $defaultRole])
            ->allowMultipleChoices()
            ->setValue([$defaultRole]) // Pass the default role as an array
            ->setRequired(true)
            ->setFormTypeOption('invalid_message', 'You must select the "Admin" role.');
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

}
