<?php

namespace App\Controller\Admin;

use App\Entity\Peliculas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PeliculasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peliculas::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference Comment')
            ->setEntityLabelInPlural('Películas')
            ->setSearchFields(['titulo', 'genero', 'productora'])
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm()
        ;
        yield TextField::new('titulo', 'Título');
        yield DateTimeField::new('fecha_publicacion', 'Fecha de publicación');
        yield TextField::new('genero', 'Género');
        yield IntegerField::new('duracion', 'Duración');
        yield TextField::new('productora', 'Productora');
        yield AssociationField::new('Directores', 'Director(s)')
            ->hideOnIndex()
            ->autocomplete()
        ;
        yield AssociationField::new('Actores', 'Actor(es)')
            ->hideOnIndex()
            ->autocomplete()
        ;
    }
}
