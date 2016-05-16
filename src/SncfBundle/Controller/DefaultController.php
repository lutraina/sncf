<?php

namespace SncfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SncfBundle:Default:index.html.twig');
    }
}
