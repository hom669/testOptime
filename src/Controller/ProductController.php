<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use Doctrine\Persistence\ManagerRegistry;
use Monolog\DateTimeImmutable;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine,DataTableFactory $dataTableFactory,ValidatorInterface $validator) {
        $this->doctrine = $doctrine;
        $this->dataTableFactory = $dataTableFactory;
        $this->validator = $validator;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $dataProduct = $this->getProducts();

        //$tableProduct = $this->createTableProducts($request,$dataProduct,$this->dataTableFactory);

      /*   return $this->render('product/index.html.twig', [
            'controller_name' => 'Mostrar Productos',
            'products' => $dataProduct,
        ]); */

        return $this->render('product/index.html.twig', ['controller_name' => 'Mostrar Productos','data_product' => $dataProduct]);
    }

    /**
     * @Route("/createProduct", name="createProduct")
     */
    public function createProduct(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        $categories = $this->getCategories();

        $errors_equals="";
        if($request->request->all()){
            $validateCreated = $this->validateCreated($request);
            if($validateCreated){$errors_equals = "El codigo del Producto y Nombre Ya estan en Creados";}
        }

        if($form->isSubmitted() && $form->isValid() && !$validateCreated){
            $product = $this->addProduct($request);
            return $this->render('alert.html.twig', [
                'message' => 'Producto Creado Exitosamente '.$product->getName().' Con codigo '.$product->getCodeProd(),
                'type' => 'success',
                'url' => '/',
                'title' => 'Creado'
            ]);
        }

        

        return $this->render('product/create.html.twig', [
            'controller_name' => 'Crear Producto',
            'categories' => $categories,
            'flash_message' => "",
            'type_error' => "",
            'form' => $form->createView(),
            'error_equals' => $errors_equals,
        ]);

    }

    /**
     * @Route("/editProduct/{product}", name="editProduct")
     */
    public function editProduct(Product $product, Request $request): Response
    {
        $form = $this->createForm(ProductType::class,$product);
        $form->handleRequest($request);
        $categories = $this->getCategories();
        //dd($request->request->all());

        if($form->isSubmitted() && $form->isValid()){
            $product = $this->editedProduct($request,$product);
            return $this->render('alert.html.twig', [
                'message' => 'Producto Editado Exitosamente '.$product->getName().' Con codigo '.$product->getCodeProd(),
                'type' => 'success',
                'url' => '/',
                'title' => 'Editado'
            ]);
        }

        return $this->render('product/edit.html.twig', [
            'controller_name' => 'Crear Producto',
            'categories' => $categories,
            'flash_message' => "",
            'type_error' => "",
            'form' => $form->createView(),
        ]);

    }

     /**
     * @Route("/deletedProduct/{id_product}", name="deletedProduct")
     */
    public function deletedProduct($id_product): Response
    {
        $product = $this->deleteProduct($id_product);
        //var_dump($product);
        return $this->render('alert.html.twig', [
            'message' => 'Producto Eliminado Exitosamente',
            'type' => 'success',
            'url' => '/',
            'title' => 'Eliminado'
        ]);
    }
    
    public function getProduct($id_product){
        $em = $this->doctrine;
        $products = $em->getRepository(Product::class)->findBy(
            array('id'=> $id_product), 
          );
        return $products;

    }

    public function addProduct($request){
        
        $fechaActual = new DateTimeImmutable(date('d-m-Y'));
        $em = $this->doctrine->getManager();
        $category = $em->getReference(Category::class, $request->request->get('product')['categories']);
        $product = new Product();
        $product->setCodeProd($request->request->get('product')['CodeProd']);
        $product->setName($request->request->get('product')['name']);
        $product->setBrand($request->request->get('product')['brand']);
        $product->setPrice($request->request->get('product')['price']);
        $product->setCategories($category);
        $product->setCreatedAt($fechaActual);
        $product->setUpdatedAt($fechaActual);
        $product->setIsActive(true);
        $em->persist($product);
        $em->flush();

        return $product;

    }

    public function editedProduct($request,$product){


        $fechaActual = new DateTimeImmutable(date('d-m-Y'));     
        $em = $this->doctrine->getManager();
        $category = $em->getReference(Category::class, $request->request->get('product')['categories']);   
        if (!$product) { 
           throw $this->createNotFoundException( 
              'No se encontro el producto '.$id_product 
           ); 
        } 

        $product->setCodeProd($request->request->get('product')['CodeProd']);
        $product->setName($request->request->get('product')['name']);
        $product->setBrand($request->request->get('product')['brand']);
        $product->setPrice($request->request->get('product')['price']);
        $product->setCategories($category);
        $product->setCreatedAt($fechaActual);
        $product->setUpdatedAt($fechaActual);
        $product->setIsActive(true);
        $em->persist($product);
        $em->flush();

        return $product;

    }

    public function deleteProduct($id_product){
        $em = $this->doctrine->getManager();
        $product = $em->getRepository(Product::class)->find($id_product);  
        
        if (!$product) { 
           throw $this->createNotFoundException( 
              'No se encontro el producto '.$id_product 
           ); 
        } 
        $product->setIsActive(false); 
        $em->flush(); 
        
        return new Response('Se Actualizo el Producto!'); 

    }

    public function getProducts(){
        $em = $this->doctrine;
        $products = $em->getRepository(Product::class)->findBy(array('is_active' => true ));
        return $products;

    }

    public function validateCreated(Request $request){
        $em = $this->doctrine->getManager();
        $productExistCode = $em->getRepository(Product::class)->findBy(array('CodeProd' => $request->request->get('product')['CodeProd']));
        $productExistName = $em->getRepository(Product::class)->findBy(array('name' => $request->request->get('product')['name']));

        $exist = $productExistCode || $productExistName ? "Exist" : "";

        return $exist;
        

    }

    public function getCategories(){
        $em = $this->doctrine;
        $categories = $em->getRepository(Category::class)->findAll();
        return $categories;

    }

    public function getCategorie($id_category){
        $em = $this->doctrine;
        $category = $em->getRepository(Category::class)->findBy(
            array('id'=> $id_category), 
          );
        return $category;

    }

}
