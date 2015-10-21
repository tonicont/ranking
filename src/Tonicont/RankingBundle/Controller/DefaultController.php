<?php

namespace Tonicont\RankingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tonicont\RankingBundle\Entity\Jugador;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TonicontRankingBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createJugadorAction()
    {
        $jugador = new Jugador();
        $jugador->setNombre('Antonio Contreras');

        $em = $this->getDoctrine()->getManager();
        $em->persist($jugador);
        $em->flush();

        return new Response('Created jugador id '.$jugador->getId());
    }
}
