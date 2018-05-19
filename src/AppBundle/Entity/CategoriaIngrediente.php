<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * CategoriaIngrediente
 *
 * @ORM\Table(name="categoria_ingrediente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaIngredienteRepository")
 * @ExclusionPolicy("all")
 */
class CategoriaIngrediente extends Categoria {

}
