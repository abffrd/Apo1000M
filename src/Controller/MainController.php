<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/accueil", name="app_home")
     */
    public function home(): Response
    {
        return $this->render('main/accueil.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    

    /**
     * @Route("/list", name="app_list")
     */
    public function list(): Response
    {
        return $this->render('integration/list.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/equipe", name="app_team")
     */
    public function team(): Response
    {
        return $this->render('main/team.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/oublie", name="app_oublie")
     */
    public function forgetpassword(): Response
    {
        return $this->render('main/oublie.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
