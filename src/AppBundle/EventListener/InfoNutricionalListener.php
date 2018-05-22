<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\InformacionNutricional;

class InfoNutricionalListener {

    function __construct($container) {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof InformacionNutricional) {
            $entity->setGrasasTotales($entity->getGrasasSaturadas() + $entity->getGrasasTrans());
        }
    }

}
