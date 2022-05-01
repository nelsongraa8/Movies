<?php

namespace App\Controller\Admin;

use App\Entity\Peliculas;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PeliculasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peliculas::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield TextField::new('titulo');
        yield DateTimeField::new('fecha_publicacion');
        yield TextField::new('genero');
        yield IntegerField::new('duracion');
        yield TextField::new('productora');
    }
}
