<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ThemesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Themes::class;
    }
    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Thèmes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('name_theme')
                ->setLabel('Titre')
                ->setRequired(true),
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
