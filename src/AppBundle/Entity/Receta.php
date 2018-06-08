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
 * @ORM\Table(name="recetas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecetaRepository")
 * @ExclusionPolicy("all")
 */
class Receta {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"Receta"})
     */
    protected $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $nombre;

    /**
     * @ORM\Column(name="descripcion", type="string", length=400, nullable=true)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $descripcion;

    /**
     * @ORM\Column(name="dificultad", type="integer", nullable=false)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $dificultad;
    
    /**
     * @ORM\Column(name="personas", type="integer")
     * @Expose
     * @Groups({"Receta"})
     */
    protected $personas;

    /**
     * @ORM\Column(name="tiempo", type="integer", nullable=false)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $tiempo;

    /**
     * @ORM\Column(type="json_array")
     * @Expose
     * @Groups({"Receta"})
     */
    protected $imagenes;

    /**
     * @ORM\Column(name="video", type="string", length=500, nullable=false)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $video;

    /**
     * @ORM\OneToMany(targetEntity="ItemReceta", mappedBy="receta")
     * @Expose
     * @Groups({"Receta"})
     */
    private $ingredientes;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriaReceta")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * @Expose
     * @Groups({"Receta"})
     */
    protected $categoria;

    /**
     * @ORM\ManyToMany(targetEntity="EnfermedadAlimenticia")
     * @ORM\JoinTable(name="receta_enfermedad",
     *      joinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="enfermedad_id", referencedColumnName="id")}
     *      )
     * @Expose
     * @Groups({"Receta"})
     */
    protected $apto_para;

    /**
     * @ORM\OneToMany(targetEntity="Paso", mappedBy="receta", cascade={"remove"})
     * @Expose
     * @Groups({"Receta"})
     */
    protected $pasos;
    
    /**
     * @ORM\OneToOne(targetEntity="InformacionNutricional", cascade={"persist"})
     * @Expose
     * @Groups({"Receta"})
     */
    protected $info_nutricional;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     * @Expose
     * @Groups({"Receta"})
     */
    protected $creador;

    function __construct() {
        $this->ingredientes = new ArrayCollection();
        $this->apto_para = new ArrayCollection();
        $this->pasos = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getDificultad() {
        return $this->dificultad;
    }
    
    function getPersonas() {
        return $this->personas;
    }

    function getTiempo() {
        return $this->tiempo;
    }

    function getImagenes() {
        return $this->imagenes;
    }

    function getVideo() {
        return $this->video;
    }

    public function getIngredientes() {
        $ingredientes = array();
        foreach ($this->ingredientes as $ingrediente) {
            array_push($ingredientes, $ingrediente->getIngrediente());
        }
        return $ingredientes;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getAptoPara() {
        return $this->apto_para;
    }

    function getPasos() {
        return $this->pasos;
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

    function setDificultad($dificultad) {
        $this->dificultad = $dificultad;
    }
    
    function setPersonas($personas) {
        $this->personas = $personas;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setImagenes($imagenes) {
        $this->imagenes = $imagenes;
    }

    function setVideo($video) {
        $this->video = $video;
    }

    function setIngredientes($ingredientes) {
        $this->ingredientes = $ingredientes;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setAptoPara($apto_para) {
        $this->apto_para = $apto_para;
    }

    function setPasos($pasos) {
        $this->pasos = $pasos;
    }

    public function addIngrediente($item) {
        $this->ingredientes[] = $item;
        return $this;
    }
    
    public function addPaso($item) {
        $this->pasos[] = $item;
        return $this;
    }
    
    public function getInfoNutricional() {
        return $this->info_nutricional;
    }
    
    public function setInfoNutricional($info_nutricional) {
        $this->info_nutricional = $info_nutricional;
        return $this;
    }
    
    public function getCreador() {
        return $this->creador;
    }
    
    public function setCreador($creador) {
        $this->creador = $creador;
        return $this;
    }

}
