<?php

namespace App\Form;

use App\Entity\Glasses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class)
            ->add('frameMaterial', TextType::class)
            ->add('frameForm', TextType::class)
            ->add('frameColor', TextType::class)
            ->add('brand', TextType::class)
            ->add('lenzMaterial', TextType::class)
            ->add('faceForm', TextType::class)
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
