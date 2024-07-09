<?php

namespace App\Controller\Admin;

use App\Entity\Cursus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
                ->setLabel('Thèmes')
                ->setRequired(true),
            TextField::new('name_cursus',)
                ->setLabel("Titre")
                ->setRequired(true),            
            TextField::new('price')
                ->setLabel('Tarif')
                ->setRequired(true),
            TextField::new('fichierFile')
                ->setFormType(VichFileType::class)
                ->setRequired(true)
                ->onlyOnForms(),
            TextField::new('fichiers')
                ->onlyOnIndex(),
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
