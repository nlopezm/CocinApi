<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * ItemPedido
 *
 * @ORM\Table(name="items_receta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ItemRecetaRepository")
 * @ExclusionPolicy("all")
 */
class ItemReceta {

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Receta", inversedBy="ingredientes")
     * @ORM\JoinColumn(name="receta_id", referencedColumnName="id")
     */
    protected $receta;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Ingrediente")
     * @ORM\JoinColumn(name="ingrediente_id", referencedColumnName="id")
     * @Expose
     * @Groups({""})
     */
    protected $ingrediente;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"unsigned":true})
     * @Expose
     * @Groups({"Receta"})
     */
    protected $cantidad;

    function getReceta() {
        return $this->receta;
    }

    function getIngrediente() {
        return $this->ingrediente;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function setReceta($receta) {
        $this->receta = $receta;
    }

    function setIngrediente($ingrediente) {
        $this->ingrediente = $ingrediente;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

}
