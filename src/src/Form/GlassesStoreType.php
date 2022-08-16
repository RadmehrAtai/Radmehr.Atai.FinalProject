<?php

namespace App\Form;

use App\Entity\GlassesStore;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlassesStoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'forms.glassstore.name'])
            ->add('address', TextType::class, ['label' => 'forms.glassstore.address'])
            ->add('phone', TelType::class, ['label' => 'forms.glassstore.phone'])
            ->add('imageUrl', UrlType::class, ['label' => 'forms.glassstore.url'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GlassesStore::class,
        ]);
    }
}
