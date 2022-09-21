<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class ApiProductController extends AbstractController
{
    #[Route('/api/{user_id}/addproduct', name: 'app_api_add', methods:['POST'])]
    public function registerProduct( Request $request, SerializerInterface $serializer, ProductRepository $productRepository, UserRepository $userRepository, int $user_id, EntityManagerInterface $em): Response
    {

        $user = $userRepository->find($user_id);
  
        $productRegistered = $request->getContent();
        
       
        

        try {
            $product = $serializer->deserialize($productRegistered, Product::class, 'json', ['groups' => ['add_product']]);
            $product->setUser($user);
            $em->persist($product);
            $em->flush();
         $response = $this->json($product, 201, []);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        } catch (NotEncodableValueException $e) {
           return $this->json([
            'status' => 400,
            'message' => $e->getMessage()
           ], 400);

       

    }

 }

       
   

    #[Route('/api/products', name: 'app_api_product', methods:['GET'])]
    public function getProducts(ProductRepository $productRepository)
    {

        $products = $productRepository->findAll();
  
        $response = $this->json($products, 200, [], ['groups' => 'show_products']);

        $response->headers->set('Access-Control-Allow-Origin', '*');
    
        return $response;
    }
}
