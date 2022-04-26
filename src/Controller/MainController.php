<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
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

  /**
     * @Route("/rdv", name="rdv")
     */
    public function rdv(CalendarRepository $calendar )
    {
        $events = $calendar->findAll();

        $rdvs = [];

        foreach($events as $event){

            $rdvs[] = [

                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getAdoptant()->getPrenom(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'textColor' => $event->getTextColor(),
                'allDay' => $event->getAllDay(),
               
            ];
        }

        $data = json_encode($rdvs);
       

        return $this->render('main/rdv.html.twig', compact('data') );
    }





}
