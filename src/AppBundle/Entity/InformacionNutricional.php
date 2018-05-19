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
    protected $calorias;

    /**
     * @ORM\Column(name="grasas_totales", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $grasas_totales;

    /**
     * @ORM\Column(name="grasas_saturadas", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $grasas_saturadas;

    /**
     * @ORM\Column(name="grasas_trans", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $grasas_trans;

    /**
     * @ORM\Column(name="sodio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $sodio;

    /**
     * @ORM\Column(name="carbohidratos", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $carbohidratos;

    /**
     * @ORM\Column(name="azucares", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $azucares;

    /**
     * @ORM\Column(name="proteinas", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $proteinas;

    /**
     * @ORM\Column(name="calcio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $calcio;

    /**
     * @ORM\Column(name="hierro", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $hierro;

    /**
     * @ORM\Column(name="potacio", type="integer", nullable=false)
     * @Expose
     * @Groups({"InformacionNutricional", "Ingrediente"})
     */
    protected $potacio;

    function getId() {
        return $this->id;
    }

    function getCantidad() {
        return $this->cantidad;
    }

    function getCalorias() {
        return $this->calorias;
    }

    function getGrasasTotales() {
        return $this->grasas_totales;
    }

    function getGrasasSaturadas() {
        return $this->grasas_saturadas;
    }

    function getGrasasTrans() {
        return $this->grasas_trans;
    }

    function getSodio() {
        return $this->sodio;
    }

    function getCarbohidratos() {
        return $this->carbohidratos;
    }

    function getAzucares() {
        return $this->azucares;
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

    function getPotacio() {
        return $this->potacio;
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

    function setGrasasTotales($grasas_totales) {
        $this->grasas_totales = $grasas_totales;
    }

    function setGrasasSaturadas($grasas_saturadas) {
        $this->grasas_saturadas = $grasas_saturadas;
    }

    function setGrasasTrans($grasas_trans) {
        $this->grasas_trans = $grasas_trans;
    }

    function setSodio($sodio) {
        $this->sodio = $sodio;
    }

    function setCarbohidratos($carbohidratos) {
        $this->carbohidratos = $carbohidratos;
    }

    function setAzucares($azucares) {
        $this->azucares = $azucares;
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

    function setPotacio($potacio) {
        $this->potacio = $potacio;
    }

}
