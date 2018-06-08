<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\HasLifecycleCallbacks
 * @ExclusionPolicy("all")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
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
     * @ORM\Column(type="string", unique=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $mail;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $imagen;

    /**
     * @ORM\ManyToMany(targetEntity="Receta")
     * @ORM\JoinTable(name="usuario_favorito",
     *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="receta_id", referencedColumnName="id")}
     *      )
     * @Expose
     * @Groups({"Usuario"})
     */
    protected $favoritos;
    
    function __construct() {
        $this->favoritos = new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getMail() {
        return $this->mail;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getFavoritos() {
        return $this->favoritos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setFavoritos($favoritos) {
        $this->favoritos = $favoritos;
    }
    
    public function addFavorito($item) {
        $this->favoritos[] = $item;
        return $this;
    }
    
    public function deleteFavorito($id) {
        foreach ($this->favoritos as $i => $receta)
            if ($receta->getId() == $id)
                unset($this->favoritos[$i]);
    }

}