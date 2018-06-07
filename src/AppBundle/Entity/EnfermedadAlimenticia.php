<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * EnfermedadAlimenticia
 *
 * @ORM\Table(name="enfermedades")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnfermedadAlimenticiaRepository")
 * @ExclusionPolicy("all")
 */
class EnfermedadAlimenticia {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Expose
     * @Groups({"Receta", "Ingrediente"})
     */
    protected $nombre;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
