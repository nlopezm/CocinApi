<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Puntuacion
 *
 * @ORM\Table(name="puntuaciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PuntuacionRepository")
 * @ExclusionPolicy("all")
 */
class Puntuacion {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * @Expose
     * @Groups({"Receta","Usuario"})
     */
    protected $usuario;
    
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Receta")
     * @ORM\JoinColumn(name="receta_id", referencedColumnName="id")
     * @Expose
     * @Groups({"Receta","Usuario"})
     */
    protected $receta;

    /**
     * @ORM\Column(name="puntuacion", type="integer", nullable=false)
     * @Expose
     * @Groups({"Receta", "Usuario"})
     */
    protected $puntuacion;

    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getReceta() {
        return $this->receta;
    }

    function getPuntuacion() {
        return $this->puntuacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setReceta($receta) {
        $this->receta = $receta;
    }

    function setPuntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;
    }

}
