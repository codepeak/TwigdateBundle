<?php

namespace Codepeak\TwigdateBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CodepeakTwigdateBundle:Default:index.html.twig', array('name' => $name));
    }
}
