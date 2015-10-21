<?php

namespace Tonicont\RankingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuedadaJugador
 *
 * @ORM\Table(name="quedada_jugador", indexes={@ORM\Index(name="fk_qj_jugador", columns={"jugador"})})
 * @ORM\Entity
 */
class QuedadaJugador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="quedada", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $quedada;

    /**
     * @var integer
     *
     * @ORM\Column(name="jugador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $jugador;

    /**
     * @var integer
     *
     * @ORM\Column(name="ganados", type="integer", nullable=false)
     */
    private $ganados;



    /**
     * Set quedada
     *
     * @param integer $quedada
     *
     * @return QuedadaJugador
     */
    public function setQuedada($quedada)
    {
        $this->quedada = $quedada;

        return $this;
    }

    /**
     * Get quedada
     *
     * @return integer
     */
    public function getQuedada()
    {
        return $this->quedada;
    }

    /**
     * Set jugador
     *
     * @param integer $jugador
     *
     * @return QuedadaJugador
     */
    public function setJugador($jugador)
    {
        $this->jugador = $jugador;

        return $this;
    }

    /**
     * Get jugador
     *
     * @return integer
     */
    public function getJugador()
    {
        return $this->jugador;
    }

    /**
     * Set ganados
     *
     * @param integer $ganados
     *
     * @return QuedadaJugador
     */
    public function setGanados($ganados)
    {
        $this->ganados = $ganados;

        return $this;
    }

    /**
     * Get ganados
     *
     * @return integer
     */
    public function getGanados()
    {
        return $this->ganados;
    }
}
