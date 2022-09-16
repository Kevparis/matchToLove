<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{

    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->manager = $manager;
        $this->passwordHasher = $passwordHasher;
        // $this->request = $request;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function index(Request $request): Response // Request est une classe qui permet en l'occurence de récupérer les données d'un formulairevia l'url. ! on utilise le use avec HttpFoundation. EntityManagerInterface va nous permettre de pouvoir ensuite envoyer en bdd.
    {
        // Je vais instancier un nouvel user (et importation de la classe User cette fois non pas via un require_once classique maiis via un Use en cliquant droit sur User -> import class et sélectionner app\Entity\User)
        $user = new User();
        // Je vais matéialiser un formulaire
        $registerForm = $this->createForm(RegisterType::class, $user); // La méthode createForm est une méthode de AbstractController qui permet de matérialiser un formulaire. Il fera matcher la registerType  avec l'instance $user

        $registerForm->handleRequest($request); // handleRequest() est une méthode de AbstractController qui permet de traiter la requête. 

        // Je vais y traiter le formulaire avec des conditions
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {

            $user->setCreatedAt(new \DateTime); //On set la date de création de l'utilisateur pour pouvoir l'envoyer en bdd
            // dd($registerForm->getData()); // Récupérer les données venant des champs du formulaire remplis, la fp=onction DD c'est comme le var_dump pour debuguer

            // Faire en sorte d'encoder le password avant l'envoi en bdd
            // $user->setFullname($user->getLastname() . ' ' . $user->getFirstname());
            $password = $this->passwordHasher->hashPassword($user, $user->getPassword()); // On hashe le mot de passe
            $user->setPassword($password);  // On set le mot de passe hashé

            $this->manager->persist($user); // On prépare les données à être envoyés ($user)
            $this->manager->flush(); // On envoie les donées à la base de donnéees;

        }

        // Je vais enregistrer l'utilisateur en base de données.


        return $this->render('register/index.html.twig', [
            'registerForm' => $registerForm->createView() // Sans createView, $registerForm saffiche en noir comme un objet. createView est une méthode de AbstractController qui permet de créer une vue du formulaire et la faire afficher comme un formulaire classique normal
        ]);
    }
}
