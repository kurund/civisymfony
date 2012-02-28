<?php

namespace Civi\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HelloController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('CiviHelloBundle:Hello:index.html.twig', array('name' => $name));
    }
}
