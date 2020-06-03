<?php

namespace App\Form;

use App\Entity\Legume;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LegumeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('origin')
            ->add('imageFile', FileType::class, ['required'=>false])
            ->add('proteine')
            ->add('lipide')
            ->add('glucide')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Legume::class,
        ]);
    }
}
