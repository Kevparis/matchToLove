<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHash)
    {
        $this->manager = $manager;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {

        $user = $this->manager->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_all' => $user
        ]);
    }

    /**
     * @Route("/user/woman", name="app_woman_user")
     */
    public function womanUser(): Response
    {
        
        $womanUser = $this->manager->getRepository(User::class)->findBySexW("femme");

        
        return $this->render('user/woman.html.twig', [
            'controller_name' => 'UserController',
            'woman_user' => $womanUser
        ]);
        
    }

        /**
     * @Route("/user/man", name="app_man_user")
     */
    public function manUser(): Response
    {

        $manUser = $this->manager->getRepository(User::class)->findBySexM("homme");
        
        return $this->render('user/man.html.twig', [
            'controller_name' => 'UserController',
            'man_user' => $manUser
        ]);
   
    }

      /**
     * @Route("/user/single/{id}", name="app_single_user")
     */
    public function viewUser($id): Response
    {
        $singleUser = $this->manager->getRepository(User::class)->findBy(['id' => $id]);

        return $this->render('user/singleUser.html.twig', [
            'controller_name' => 'UserController',
            'single_user' => $singleUser[0],
        ]);

    }

                //Pour supprimer le user
            /**
             * @Route("/user/remove/{id}", name="app_remove_user")
             */

            public function deleteUser($id)
            {

            $singleUser = $this->manager->getRepository(User::class)->findBy(['id' => $id]);
            //DELETE * FROM article WHERE article.id = $id
            $this->manager->remove($singleUser[0]);//on prepare les données à etre envoyer ($user)
            $this->manager->flush();// on envoie les données dans la base de donnée

        return $this->redirectToRoute('app_home');

        }

         //Pour modifier le user
    /**
     * @Route("/user/update/{id}", name="app_edit_user")
     */
    public function updateUser($id, Request $request, SluggerInterface $slugger)
    {
        // Je recupere dans la bdd l article grace a l'id
        $singleUser = $this->manager->getRepository(User::class)->findBy(['id' => $id]);
        $singleUser[0]->setMainPicture(null);

        // Je materialise le formulaire et je donne l atricle recuperer en bdd a celui ci
        $form = $this->createForm(RegisterType::class, $singleUser[0]);
        $form->handleRequest($request);

        // Si le formulaire et soumis et en meme temp valide alors j envoi les modification en bdd
        if ($form->isSubmitted() && $form->isValid()) {

               //reinjecter le mot de passe dans le même champ à la modification
            //on met la condition recuperer l'utilisateur connecté par son id qui est égale a $singleUser[0] par son id
            if($this->getUser()->getId() == $singleUser[0]->getId()){
                $singleUser[0]->setPassword($this->passwordHash->hashPassword($singleUser[0] , $singleUser[0]->getPassword())); // on hash le mot de passe de l'utilisateur
            }else{
                $singleUser[0]->setPassword($singleUser[0]->getPassword());// on hash le mot de passe de l'utilisateur
            }

            ///** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('mainPicture')->getData();
            //cette condition est nécessaire car le champ 'brochure' n'est pas obligatoire
            // donc le fichier PDF doit être traité uniquement lorsqu'un fichier est téléchargé
            if($pictureFile){
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);//recupere le nom
                //cela est nécessaire pour inclure en toute sécurité le nom du fichier dans l'URL
                $safeFilename = $slugger->slug($originalFilename);
                //recompose le nom du fichier concatenation : nom($safeFilename) - id unique(uniqid()) - et extension(guessExtension())
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();//uniqid() id unique ; guessExtension() recupère l'extension du fichier a uploader

                try {
                    $pictureFile->move( //deplacer les fichier dans le repertoire ou sont stockées les brochures
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch(FileException $e){//gerer l'exception si quelque chose se produit peandant le telechargement

                }
                // met à jour la propriété 'brochureFilename' pour stocker le nom du fichier PDF
                // au lieu de son contenu
                $singleUser[0]->setMainPicture($newFilename);//on envoi le nom du nouveau fichier

            }
        

            $this->manager->persist($singleUser[0]);
            $this->manager->flush();
            // Pour finir je fait une redirection
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/update.html.twig', [
            'singleUser' => $singleUser[0],
            'form' => $form->createView()
        ]);
    }

    
}
