<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->manager = $manager;
        $this->passwordHash = $passwordHasher;
        // $this->request = $request;
    }

    // Suppression

    /**
     * @Route("/user/remove/{id}", name="app_remove_user")
     */
    public function deleteUser($id)
    {
        $scratchUser = $this->manager->getRepository(User::class)->findby(['id' => $id]);

        $this->manager->remove($scratchUser[0]);
        // DELETE FROM USER WHERE profile.id = $id
        // $this->manager->save();
        $this->manager->flush();
        // EXECUTE LA REQUETE
        return $this->redirectToRoute('app_home');
    }

    // Modification

    /**
     * @Route("/user/update/{id}", name="app_update_user")
     */


    public function updateUser($id, Request $request)
    {
        // Je recupere dans la bdd le profil grace a l'id
        $singleUser = $this->manager->getRepository(User::class)->findBy(['id' => $id]);
        $singleUser[0]->setMainPicture(null);

        // Je materialise le formulaire et je donne l atricle recuperer en bdd a celui ci
        $form = $this->createForm(RegisterType::class, $singleUser[0]);
        $form->handleRequest($request);


        // Si le formulaire et soumis et en meme temp valide alors j envoi les modification en bdd
        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->getUser()->getId() == $singleUser[0]->getId()) {

                $singleUser[0]->setPassword($this->passwordHash->hashPassword($singleUser[0], $singleUser[0]->getPassword()));
            } else {

                $singleUser[0]->setPassword($singleUser[0]->getPassword());
            }

            // on hashe le mot de passe de l'utilisateur



            $this->manager->persist($singleUser[0]);
            $this->manager->flush();
            // Pour finir je fait une redirection
            return $this->redirectToRoute('app_home');
        }

        // dd($singleUser[0]);

        return $this->render('user/update.html.twig', [
            'singleUser' => $singleUser[0],
            'form' => $form->createView()
        ]);
    }



    // Afficher profil

    /**
     * @Route("/profile/single/{id}", name="app_single_profile")
     */
    public function viewProfile($id): Response
    {

        $singleProfile = $this->manager->getRepository(User::class)->findby(['id' => $id]);
        dd($singleProfile[0]); 

        return $this->render('user/profile.html.twig', [
            'singleProfile' => $singleProfile[0]

        ]);
    }
}
