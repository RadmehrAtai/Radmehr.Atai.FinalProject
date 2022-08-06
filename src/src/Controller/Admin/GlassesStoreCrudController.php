<?php

namespace App\Controller\Admin;

use App\Entity\GlassesStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GlassesStoreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GlassesStore::class;
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
