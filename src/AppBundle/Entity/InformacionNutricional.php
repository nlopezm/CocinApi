<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * InformacionNutricional
 *
 * @ORM\Table(name="informacion_nutricional")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InformacionNutricionalRepository")
 * @ExclusionPolicy("all")
 */
class InformacionNutricional {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"InformacionNutricional"})
     */
    protected $id;

    /**
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $cantidad;

    /**
     * @ORM\Column(name="calorias", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})     
     */
    protected $calorias = 0;

    /**
     * @ORM\Column(name="grasas_totales", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $grasas_totales = 0;

    /**
     * @ORM\Column(name="sodio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $sodio = 0;

    /**
     * @ORM\Column(name="carbohidratos", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $carbohidratos = 0;

    /**
     * @ORM\Column(name="fibras", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $fibras = 0;

    /**
     * @ORM\Column(name="proteinas", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $proteinas = 0;

    /**
     * @ORM\Column(name="calcio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $calcio = 0;

    /**
     * @ORM\Column(name="hierro", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $hierro = 0;

    /**
     * @ORM\Column(name="potacio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $potasio = 0;

    /**
     * @ORM\Column(name="colesterol", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $colesterol = 0;

    /**
     * @ORM\Column(name="magnesio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $magnesio = 0;

    /**
     * @ORM\Column(name="zinc", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $zinc = 0;

    function getId() {
        return $this->id;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getCalorias() {
        return $this->calorias;
    }

    function getGrasas_totales() {
        return $this->grasas_totales;
    }

    function getSodio() {
        return $this->sodio;
    }

    function getCarbohidratos() {
        return $this->carbohidratos;
    }

    function getFibras() {
        return $this->fibras;
    }

    function getProteinas() {
        return $this->proteinas;
    }

    function getCalcio() {
        return $this->calcio;
    }

    function getHierro() {
        return $this->hierro;
    }

    function getPotasio() {
        return $this->potasio;
    }

    function getColesterol() {
        return $this->colesterol;
    }

    function getMagnesio() {
        return $this->magnesio;
    }

    function getZinc() {
        return $this->zinc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    function setCalorias($calorias) {
        $this->calorias = $calorias;
    }

    function setGrasas_totales($grasas_totales) {
        $this->grasas_totales = $grasas_totales;
    }

    function setSodio($sodio) {
        $this->sodio = $sodio;
    }

    function setCarbohidratos($carbohidratos) {
        $this->carbohidratos = $carbohidratos;
    }

    function setFibras($fibras) {
        $this->fibras = $fibras;
    }

    function setProteinas($proteinas) {
        $this->proteinas = $proteinas;
    }

    function setCalcio($calcio) {
        $this->calcio = $calcio;
    }

    function setHierro($hierro) {
        $this->hierro = $hierro;
    }

    function setPotasio($potasio) {
        $this->potasio = $potasio;
    }

    function setColesterol($colesterol) {
        $this->colesterol = $colesterol;
    }

    function setMagnesio($magnesio) {
        $this->magnesio = $magnesio;
    }

    function setZinc($zinc) {
        $this->zinc = $zinc;
    }

}
