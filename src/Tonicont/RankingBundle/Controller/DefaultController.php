<?php

namespace Tonicont\RankingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tonicont\RankingBundle\Entity\Jugador;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tonicont\RankingBundle\Entity\Quedada;
use Tonicont\RankingBundle\Entity\QuedadaJugador;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TonicontRankingBundle:Default:index.html.twig', array('name' => $name));
    }

    /**
     *
     */
    public function createJugadorAction(Request $request)
    {
        $jugador = new Jugador();

        $form = $this->createFormBuilder($jugador)
            ->add('nombre', 'text', array('label' => 'Nombre Jugador', 'required' => 'true'))
            ->add('guardar', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // guardar la tarea en la base de datos

            $em = $this->getDoctrine()->getManager();
            $em->persist($jugador);
            $em->flush();

            return $this->redirect($this->generateUrl('tonicont_ranking_listaJugadores'));
        }

        return $this->render('TonicontRankingBundle:Default:crear_jugador.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     *
     */
    public function listarJugadoresAction(){

        $em = $this->getDoctrine()->getManager();
        $jugadores = $em->getRepository('TonicontRankingBundle:Jugador')->findAll();

        return $this->render('TonicontRankingBundle:Default:lista_jugadores.html.twig', array('jugadores' => $jugadores));
    }

    /**
     *
     */
    public function crearQuedadaAction(Request $request)
    {
        $quedada = new Quedada();

        $form = $this->createFormBuilder($quedada)
            ->add('fecha', 'date', array('label' => 'Fecha'))
            ->add('hora', 'time', array('label' => 'Hora'))
            ->add('description', 'textarea', array('label' => 'Descripcion'))
            ->add('Guardar', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($quedada);
            $em->flush();
            return $this->redirect($this->generateUrl('tonicont_ranking_listaQuedadas'));
        }

        return $this->render('TonicontRankingBundle:Default:crear_quedada.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function listarQuedadasAction(){
        $em = $this->getDoctrine()->getManager();
        $quedadas = $em->getRepository('TonicontRankingBundle:Quedada')->findAll();

        return $this->render('TonicontRankingBundle:Default:lista_quedadas.html.twig', array('quedadas' => $quedadas));
    }

    public function editarQuedadaAction($id){
        $em = $this->getDoctrine()->getManager();
        $jugadores = $em->getRepository('TonicontRankingBundle:Jugador')->findAll();
        $inscritos = [];
        $repository = $this->getDoctrine()->getRepository('TonicontRankingBundle:QuedadaJugador');
        $query = $repository->createQueryBuilder('i')
            ->where('i.quedada = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $i = $query->getResult();


        foreach($i as $item)
        {
            $inscritos[] = $em->getRepository('TonicontRankingBundle:Jugador')->find($item->getJugador());
        }

        return $this->render('TonicontRankingBundle:Default:quedada.html.twig', array('jugadores' => $jugadores, 'inscritos' => $inscritos, 'id' => $id));
    }

    public function inscribirJugadoresQuedadaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
          'DELETE FROM TonicontRankingBundle:QuedadaJugador q
            WHERE q.quedada = :id_quedada'
        )->setParameter('id_quedada', $id);

        $result = $query->getResult();

        foreach($_GET as $key => $value)
        {
            if($value == 'S')
            {
                $inscripcion = new QuedadaJugador();
                $inscripcion->setJugador($key);
                $inscripcion->setQuedada($id);
                $inscripcion->setGanados(0);
                $em->persist($inscripcion);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('tonicont_ranking_quedada', array('id' => $id)));
    }
}
