<?php

namespace DemandeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/demande")
     */
    public function indexAction()
    {
        return $this->render('DemandeBundle:Default:index.html.twig');
    }
}
