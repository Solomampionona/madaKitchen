<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/', name: 'acceuil')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    
    }
         /**
         * @Route("/product/add", name="product_add")
         */

    public function add(ManagerRegistry $doctrine)
        {
            $entityManager = $doctrine->getManager();
    
            $products = new $products;
            $products->setTitle("VOITURE");
            $products->setPrix("30");
            $products->setContent("la vie est belle");
            $products->setcreatedat(new \DateTimeImmutable());
            $products->setUpdatedat(new \DateTimeImmutable());
            
            $entityManager->persist($products);
            $entityManager->flush();
    
            return $this->redirectToRoute('home');
        }
        /**
         * @Route("/products/edit/{id}", name="products_edit")
         */
        public function edit($id, ManagerRegistry $doctrine)
        {
            $entityManager = $doctrine->getManager();
            $products = $doctrine->getRepository(Product::class)->find($id);
            $products->setTitle("Ceci est ma nouvelle titre !!!!");
            $entityManager->flush();
    
            return new Response("<h1>Bravo le product a été modifié !!</h1>");
        }
    
        /**
         * @Route("/products/delete/{id}", name="products_delete")
         */
        public function delete($id, ManagerRegistry $doctrine)
        {
        
            $entityManager = $doctrine->getManager();
            $products = $doctrine->getRepository(Products::class)->find($id); 
            $entityManager->remove($products);
    
            $entityManager->flush();
    
            #Etape 5 : On affiche ou on redirige vers une autre page
            return new Response("<h1>Bravo leproduct a été supprimé !!</h1>");        
        }
    
        ##READ : ALL
        /**
         * @Route("/products/list", name="products_list")
         */
        public function readAll(ManagerRegistry $doctrine)
        {
            $products = $doctrine->getRepository(Products::class)->findAll();
    
            return $this->render("products/list.html.twig", [
                "products" =>  $products
            ]);
        }
    
        /**
         * @Route("/products/detail/{id}", name="products_detail")
         */
        public function detail($id, ManagerRegistry $doctrine)
        {
            $annonce = $doctrine->getRepository(Products::class)->find($id); 
    
            return $this->render('products/item.html.twig', [
                "products" =>  $products
            ]);
        }    
        
    
    
    }

