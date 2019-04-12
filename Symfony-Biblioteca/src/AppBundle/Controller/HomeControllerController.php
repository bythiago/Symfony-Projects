<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeControllerController extends Controller
{
    /**
    * @Route("/", name="app_homepage")
    */
    public function homeAction(){
        return $this->render('AppBundle:Home:index.html.twig', ['errors' => null]);
    }
}
