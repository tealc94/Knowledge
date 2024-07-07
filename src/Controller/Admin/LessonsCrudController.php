<?php

namespace App\Controller\Admin;

use App\Entity\Lessons;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class LessonsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lessons::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Leçons');
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
            DateTimeField::new('created_at')
                ->setlabel('Date de création')
                ->setFormat('dd MMMM yyyy HH:mm:ss')
                ->onlyOnIndex(),
            DateTimeField::new('updated_at')
                ->setlabel('Date de mise à jour')
                ->setFormat('dd MMMM yyyy HH:mm:ss')
                ->onlyOnIndex(),
        ];
    }    
}
