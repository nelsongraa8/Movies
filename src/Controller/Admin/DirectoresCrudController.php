<?php

namespace App\Controller\Admin;

use App\Entity\Directores;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DirectoresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Directores::class;
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
