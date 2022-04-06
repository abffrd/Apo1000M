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
        return $this->render('integration/accueil.html.twig', [
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

}
