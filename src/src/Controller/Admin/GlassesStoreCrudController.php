<?php

namespace App\Controller\Admin;

use App\Entity\GlassesStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GlassesStoreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GlassesStore::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name',),
            TextField::new('address'),
            TelephoneField::new('phone'),
            AssociationField::new('owner')
        ];
    }

}
