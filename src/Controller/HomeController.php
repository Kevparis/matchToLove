<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $profile = $this->manager->getRepository(User::class)->FindAll(); // A réduire via une condition SQL where (ses préférences) et dans tous les cas pagination  avec les for (p in page) do (i=1 to n(20 par défaut)) premiers résultats (SQL LIMIT) puis si cliqué une page k, limiter les résultats à firstobs= max(1, k-round(p/2)) , la 1ère ligne, la dernière ligne 

        // Puis re tirage aléatoire sans remise...

        // dd($profile);

        return $this->render('home/index.html.twig', [
            'profiles' => $profile
        ]);
    }

        /**
     * @Route("/redirect", name="app_redirect")
     */
    public function redirectTo() //ici on retourne une reponse donc un return
    {



        if ($this->isGranted("ROLE_ADMIN")) { // Si l'utilisateur est connecté eyt est admin
            return $this->redirectToRoute("app_backoffice");
        } else {
            return $this->redirectToRoute("app_account");
        }


        // GetUser() est une méthode interne Symfony qui récupère l'utilisateur connecté aainsi que toutes les méthodes définies dans la classe User. Cette méthode est utilisable uniquement au sein d'un controller car elle provient de la Classe AbstractController 
        // if ($this->getUser()->getRole() == 'Admin') {
        //     return $this->redirectToRoute("app_dashboard");
        // } else {
        //     return $this->redirectToRoute("app_account");
        // }
    }

}
