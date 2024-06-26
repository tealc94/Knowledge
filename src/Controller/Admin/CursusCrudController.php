<?php

namespace App\Controller\Admin;

use App\Entity\Cursus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CursusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cursus::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            AssociationField::new('idNameTheme')
                ->setLabel('Thèmes'),
            TextField::new('name_cursus',)
                ->setLabel("Titre"),            
            TextField::new('price')
                ->setLabel('Tarif'), 
            
        ];
    }    
}
