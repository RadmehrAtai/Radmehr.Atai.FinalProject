<?php

namespace App\Form;

use App\Entity\Glasses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('frameMaterial')
            ->add('frameForm')
            ->add('frameColor')
            ->add('brand')
            ->add('lenzMaterial')
            ->add('faceForm')
            ->add('price', MoneyType::class)
            ->add('description', TextareaType::class)
            ->add('glassesStore')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Glasses::class,
        ]);
    }
}
