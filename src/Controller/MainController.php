<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(): Response
    {
        return $this->render('main/login.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/accueil", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('integration/accueil.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
