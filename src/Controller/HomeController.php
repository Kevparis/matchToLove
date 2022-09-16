<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/redirect", name="app_redirect")
     */
    public function redirectToUser() // ici on retourne une reponse donc un return
    {
        //recuperer le role de l'utilisateur
        //si il a le role admin alors on le redirige vers dashboard sinon vers profil

        //la redirection dans les pages utilisateur ou utilisateur
        if($this->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('app_dashboard');
        }else{
            return $this->redirectToRoute('app_profil');
        }
    }
}
