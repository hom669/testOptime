<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('CodeProd', TextType::class,['label' => 'Código Producto','attr' => array('class' => 'form-control'),])
            ->add('name', TextType::class,['label' => 'Nombre Producto','attr' => array('class' => 'form-control')])
            ->add('brand', TextType::class,['label' => 'Marca Producto','attr' => array('class' => 'form-control')])
            ->add('price',IntegerType::class,['label' => 'Precio Producto','attr' => array('class' => 'form-control')])
            ->add('categories', EntityType::class, [
                // looks for choices from this entity
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('Guardar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
