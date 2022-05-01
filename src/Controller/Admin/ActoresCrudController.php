<?php

namespace App\Controller\Admin;

use App\Entity\Actores;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actores::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm()
        ;
        yield TextareaField::new('nombre', 'Nombre');
        yield DateTimeField::new('fecha_nacimiento', 'Fecha de nacimiento');
        yield DateTimeField::new('fecha_fallecimiento', 'Fecha de fallecimiento');
        yield TextField::new('lugar_nacimiento', 'Lugar de nacimiento');
        yield AssociationField::new('peliculas', 'Película(s)');
        ;
    }
}
