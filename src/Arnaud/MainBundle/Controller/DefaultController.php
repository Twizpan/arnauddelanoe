<?php

namespace Arnaud\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArnaudMainBundle:Main:index.html.twig');
    }
}
