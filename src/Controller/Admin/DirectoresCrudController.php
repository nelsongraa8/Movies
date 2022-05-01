<?php

namespace App\Controller\Admin;

use App\Entity\Directores;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DirectoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Directores::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('nombre');
        yield DateTimeField::new('fecha_nacimiento');
        // yield AssociationField::new('Peliculas');
    }
}
