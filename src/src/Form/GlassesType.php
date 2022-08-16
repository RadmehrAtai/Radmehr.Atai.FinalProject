<?php

namespace App\Form;

use App\Entity\Glasses;
use App\Entity\GlassesStore;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class, ['label' => 'forms.glass.model'])
            ->add('frameMaterial', TextType::class, ['label' => 'forms.glass.framematerial'])
            ->add('frameForm', TextType::class, ['label' => 'forms.glass.frameform'])
            ->add('frameColor', TextType::class, ['label' => 'forms.glass.framecolor'])
            ->add('brand', TextType::class, ['label' => 'forms.glass.brand'])
            ->add('lenzMaterial', TextType::class, ['label' => 'forms.glass.lenzmaterial'])
            ->add('faceForm', TextType::class, ['label' => 'forms.glass.faceform'])
            ->add('price', MoneyType::class, ['label' => 'forms.glass.price'])
            ->add('description', TextareaType::class, ['label' => 'forms.glass.description'])
            ->add('imageUrl', UrlType::class, ['label' => 'forms.glass.url'])
            ->add('glassesStore', EntityType::class, [
                'class' => GlassesStore::class,
                'label' => 'forms.glass.glassstore']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Glasses::class,
        ]);
    }
}
