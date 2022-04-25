<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResgisterClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterClientController extends AbstractController
{
    /**
     * @Route("/client", name="register_client")
     */
    // public function index(): Response
    // {
    //     return $this->render('register_client/index.html.twig', [
    //         'controller_name' => 'RegisterClientController',
    //     ]);
    // }
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder): Response

    
    {
        $user = new User();
        $form = $this->createForm(ResgisterClientType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $password = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);
         
            $entityManager->persist($user);
            $entityManager->flush();
            
        }
        
        return $this->render('register_client/index.html.twig', [
            'formRegister' => $form->createView(),
        ]);
      
    }
}


