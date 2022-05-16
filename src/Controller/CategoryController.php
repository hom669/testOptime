<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class CategoryController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) {
        $this->doctrine = $doctrine;
    }
    /**
     * @Route("/category", name="index")
     */
    public function index(): Response
    {
        
        //$table = $this->createTableProducts($dataProduct);
       /*  return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]); */
    }

    
}
