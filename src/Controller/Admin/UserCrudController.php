<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('email'),
            TextField::new('username')
                ->setLabel('Nom'),
            BooleanField::new('is_verified')
                ->setLabel('Vérifié'),
            ChoiceField::new('roles')
                ->setChoices([
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                ])
                ->allowMultipleChoices()
                ->renderExpanded()
        ];
    }
}
