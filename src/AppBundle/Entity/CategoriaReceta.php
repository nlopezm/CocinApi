<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * CategoriaReceta
 *
 * @ORM\Table(name="categoria_receta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRecetaRepository")
 * @ExclusionPolicy("all")
 */
class CategoriaReceta extends Categoria {
    
}
