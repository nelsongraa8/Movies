<?php

namespace App\Controller\Admin;

use App\Entity\Peliculas;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PeliculasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Peliculas::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
