<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackofficeController extends AbstractController
{


    /**
     * @Route("/backoffice", name="app_backoffice")
     */
    public function index(EntityManagerInterface $manager): Response
    {
        $allUserBackoffice = $manager->getRepository(User::class)->findAll();

        return $this->render('backoffice/index.html.twig', [
            'allUserBackoffice' => $allUserBackoffice,
        ]);
    }
}
