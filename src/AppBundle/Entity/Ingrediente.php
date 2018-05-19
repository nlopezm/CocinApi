<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Receta
 *
 * @ORM\Table(name="ingredientes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IngredienteRepository")
 * @ExclusionPolicy("all")
 */
class Ingrediente {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Ingrediente"})
     */
    protected $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Expose
     * @Groups({"Ingrediente", "Receta"})
     */
    protected $nombre;

    /**
     * @ORM\Column(name="unidad", type="string", length=25, nullable=false)
     * @Expose
     * @Groups({"Ingrediente", "Receta"})
     */
    protected $unidad;

    /**
     * @ORM\OneToOne(targetEntity="InformacionNutricional", cascade={"persist"})
     * @Expose
     * @Groups({"Ingrediente"})
     */
    protected $info_nutricional;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriaIngrediente")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * @Expose
     * @Groups({"Ingrediente"})
     */
    protected $categoria;

    /**
     * @ORM\ManyToMany(targetEntity="EnfermedadAlimenticia")
     * @ORM\JoinTable(name="ingrediente_enfermedad",
     *      joinColumns={@ORM\JoinColumn(name="ingrediente_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="enfermedad_id", referencedColumnName="id")}
     *      )
     * @Expose
     * @Groups({"Ingrediente"})
     */
    protected $apto_para;

    function __construct() {
        $this->apto_para = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getUnidad() {
        return $this->unidad;
    }

    function getInfoNutricional() {
        return $this->info_nutricional;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getAptoPara() {
        return $this->apto_para;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setUnidad($unidad) {
        $this->unidad = $unidad;
    }

    function setInfoNutricional($info_nutricional) {
        $this->info_nutricional = $info_nutricional;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setAptoPara($apto_para) {
        $this->apto_para = $apto_para;
    }

}
