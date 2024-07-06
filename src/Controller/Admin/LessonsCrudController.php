<?php

namespace App\Controller\Admin;

use App\Entity\Lessons;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LessonsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lessons::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            AssociationField::new('idNameCursus')
                ->setLabel('Cursus'),
            TextField::new('name_lesson')
                ->setLabel('Titres'),
            TextField::new('price')
                ->setLabel('Tarifs'),            
        ];
    }
    
}
