<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\EnfermedadAlimenticia;
use AppBundle\Form\EnfermedadType;

class EnfermedadController extends FOSRestController {

    /**
     * @Post("")
     */
    public function postEnfermedadAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $enfermedad = new EnfermedadAlimenticia();

        $form = $this->createForm(EnfermedadType::class, $enfermedad);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($enfermedad);
            $em->flush();
            return $enfermedad;
        } else {
            return $form;
        }
    }

    /**
     * @Get("")
     */
    public function getEnfermedadesAction() {

        $enfermedades = $this->getDoctrine()->getRepository("AppBundle:EnfermedadAlimenticia")
                ->findAll();
        if (!$enfermedades)
            throw new BadRequestHttpException('No hay enfermedades');

        return ($enfermedades);
    }


}
