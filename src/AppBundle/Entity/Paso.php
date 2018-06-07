<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Paso
 *
 * @ORM\Table(name="pasos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PasoRepository")
 * @ExclusionPolicy("all")
 */
class Paso {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Expose
     * @Groups({"Paso", "Receta"})
     */
    protected $nombre;

    /**
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     * @Expose
     * @Groups({"Paso", "Receta"})
     */
    protected $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="pasos")
     * @ORM\JoinColumn(name="receta_id", referencedColumnName="id")
     * @Expose
     * @Groups({""})
     */
    protected $receta;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getReceta() {
        return $this->receta;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setReceta($receta) {
        $this->receta = $receta;
    }

}
