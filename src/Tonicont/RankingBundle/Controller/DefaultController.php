<?php

namespace Tonicont\RankingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TonicontRankingBundle:Default:index.html.twig', array('name' => $name));
    }
}
