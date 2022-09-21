<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use DateTime;
use App\Service\UserService;


class ApiUserController extends AbstractController
{
    #[Route('/api/users', name: 'app_api_users', methods:['GET'])]
    public function getUsers(UserRepository $userRepository, UserService $userService)
    {

        $users = $userRepository->findAll();

        foreach($users as $user) {

          $age = $userService->calculateAge($user->getBirthDate());

          $user->setAge($age);

        }
       
        $response = $this->json($users, 200, [], ['groups' => 'show_users']);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    #[Route('/api/users', name: 'app_api_register', methods:['POST'])]
    public function register(Request $request, SerializerInterface $serializer, EntityManagerInterface $em) {
    
        $userRegistered = $request->getContent();

        
        try {
            $user = $serializer->deserialize($userRegistered, User::class, 'json');
                $em->persist($user);
            $em->flush();
         $response = $this->json($user, 201, []);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        } catch (NotEncodableValueException $e) {
           return $this->json([
            'status' => 400,
            'message' => $e->getMessage()
           ], 400);

       

    }
}

#[Route('api/user/{id}', name: 'user_show', methods:['GET'])]
public function getUserById(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository
            ->find($id);

            $response = $this->json($user, 200, [], ['groups' => 'show_users']);
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response; 
    }

   
 
    
    #[Route('/api/user/{id}', name: 'delete_user', methods: ['DELETE'])]
    public function deleteUser(int $id, UserRepository $userRepository, EntityManagerInterface $em): JsonResponse 
    {
        $user = $userRepository->findOneById($id);
        $em->remove($user);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

}