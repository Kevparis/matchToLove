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

class RegisterController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->manager = $manager;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $user = new User();
        
        $registerForm = $this->createForm(RegisterType::class,$user);
        $registerForm->handleRequest($request);

        if($registerForm->isSubmitted() && $registerForm->isValid()){
            $user->setCreatedAt(new \DateTime);

            ///** @var UploadedFile $pictureFile */
            $pictureFile = $registerForm->get('mainPicture')->getData();
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
                $user->setMainPicture($newFilename);//on envoi le nom du nouveau fichier

            }


            //$user->setFullname($user->getLastname(). ' ' . $user->getFirstname());
            $hashedPassword = $this->passwordHasher->hashPassword($user , $user->getPassword());
            $user->setPassword($hashedPassword);
            if($user->getPaymentOption() == null){
                $user->setPaymentOption('free');
            }

            if($user->getOptionPrice() == null){
                $user->setOptionPrice(0);
            }
            
            $this->manager->persist($user);
            $this->manager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'registerForm' => $registerForm->createView(),

        ]);
    }
}