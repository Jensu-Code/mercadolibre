<?php

declare(strict_types=1);

/*
 * This file is part of the PIDIA.
 * (c) Carlos Chininin <cio@pidia.pe>
 */

namespace App\Form;

use App\Entity\ProductoCategoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoCategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductoCategoria::class,
        ]);
    }
}
