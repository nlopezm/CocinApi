<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

/**
 * Categoría
 * @ORM\InheritanceType("JOINED")
 * @DiscriminatorColumn(name="tipo", type="string")
 * @ORM\Table(name="categorias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 * @ExclusionPolicy("all")
 * */
abstract class Categoria {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Categoria", "CategoriaIngrediente", "CategoriaReceta"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Expose
     * @Groups({"Categoria", "CategoriaIngrediente", "CategoriaReceta"})
     */
    protected $nombre;

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

}
