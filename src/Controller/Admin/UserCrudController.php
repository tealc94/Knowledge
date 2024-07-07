<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Utilisateurs');
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
                ->setLabel('Vérifié')
                ->onlyWhenUpdating(),
            ChoiceField::new('roles')
                ->setChoices([
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                ])
                ->allowMultipleChoices()
                ->renderExpanded(),
            DateTimeField::new('created_at')
                ->setLabel('Date de création')
                ->setFormat('dd MMMM yyyy HH:mm:ss')
                ->onlyOnIndex(),
            DateTimeField::new('updated_at')
                ->setLabel('Date de mise à jour')
                ->setFormat('dd MMMM yyyy HH:mm:ss')
                ->onlyOnIndex(),
        ];
    }
}
