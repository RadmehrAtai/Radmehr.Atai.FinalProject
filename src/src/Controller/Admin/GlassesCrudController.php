<?php

namespace App\Controller\Admin;

use App\Entity\Glasses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GlassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Glasses::class;
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
