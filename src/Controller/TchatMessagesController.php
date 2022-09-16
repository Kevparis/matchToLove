<?php

namespace App\Controller;





use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TchatMessagesController extends AbstractController
{

    /**
     * @Route("/tchat/messages", name="app_tchat_messages")
     */
    public function index(): Response
    {

        return $this->render('tchat_messages/index.html.twig', [
            'controller_name' => 'TchatMessagesController',
        ]);
    }

}

