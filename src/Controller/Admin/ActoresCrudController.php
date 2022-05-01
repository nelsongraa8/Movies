<?php

namespace App\Controller\Admin;

use App\Entity\Actores;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actores::class;
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
