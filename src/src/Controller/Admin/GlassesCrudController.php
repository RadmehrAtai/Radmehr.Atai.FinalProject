<?php

namespace App\Controller\Admin;

use App\Entity\Glasses;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class GlassesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Glasses::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('model'),
            TextField::new('frameMaterial'),
            TextField::new('frameForm'),
            TextField::new('frameColor'),
            TextField::new('brand'),
            TextField::new('lenzMaterial'),
            TextField::new('faceForm'),
            MoneyField::new('price')->setCurrency("USD"),
            TextareaField::new('description'),
            UrlField::new('imageUrl'),
            AssociationField::new('glassesStore')
        ];
    }
}
