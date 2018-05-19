<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\HasLifecycleCallbacks
 * @ExclusionPolicy("all")
 */
class Usuario {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $apellido;

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }

}