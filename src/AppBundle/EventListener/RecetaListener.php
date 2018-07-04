<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Receta;

class RecetaListener {

    function __construct($container) {
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Receta) {
            $imagenes = $entity->getImagenes();
            foreach ($imagenes as &$imagen)
                if (strpos($imagen, 'http') === false)
                    $imagen = $this->container->get("receta")->guardarImagen($imagen);

            $entity->setImagenes($imagenes);

            $video = $entity->getVideo();
            $entity->setVideo(str_replace("https://www.youtube.com/watch?v=", "https://www.youtube.com/embed/", $video));
        }

        $entityManager = $args->getEntityManager();
    }

    public function preUpdate($eventArgs) {
        if ($eventArgs->getEntity() instanceof Operacion) {
            $entity = $eventArgs->getEntity();
            if ($eventArgs->hasChangedField('imagenes')) {
                $imagenes = $eventArgs->getNewValue('imagenes');
                foreach ($imagenes as &$imagen) {
                    if (strpos($imagen, 'http') === false)
                        $imagen = $this->container->get("receta")->guardarImagen($imagen);
                }
                $entity->setImagenes($imagenes);
                $em = $eventArgs->getEntityManager();
                $uow = $em->getUnitOfWork();
                $meta = $em->getClassMetadata(get_class($entity));
                $uow->recomputeSingleEntityChangeSet($meta, $entity);
            }
        }
    }

}
