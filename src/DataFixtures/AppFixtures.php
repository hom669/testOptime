<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fechaActual = new DateTimeImmutable(date('d-m-Y'));
        // $product = new Product();
        // $manager->persist($product);
        $category = new Category();
        $category->setName('Electrodomesticos');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Ferreteria');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);


        $category = new Category();
        $category->setName('Alimentos');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Repuestos');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Hogar');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Electronica');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Otros');
        $category->setIsActive(true);
        $category->setIsActive(true);
        $category->setCreatedAt($fechaActual);
        $category->setUpdateAt($fechaActual);
        $manager->persist($category);
        

        $manager->flush();
    }
}
