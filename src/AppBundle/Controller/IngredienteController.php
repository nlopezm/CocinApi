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
use AppBundle\Entity\CategoriaIngrediente;
use AppBundle\Form\CategoriaType;
use AppBundle\Entity\Ingrediente;
use AppBundle\Form\IngredienteType;

class IngredienteController extends FOSRestController {

    /**
     * @Post("")
     */
    public function postIngredienteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $ingrediente = new Ingrediente();

        $form = $this->createForm(IngredienteType::class, $ingrediente);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($ingrediente);
            $em->flush();
            return $ingrediente;
        } else {
            return $form;
        }
    }
    
    /**
     * @Get("")
     */
    public function getIngredientesAction() {

        $ingredientes = $this->getDoctrine()->getRepository("AppBundle:Ingrediente")
                ->findAll();
        if (!$ingredientes)
            throw new BadRequestHttpException('No hay ingredientes');

        return ($ingredientes);
    }

    /**
     * @Post("/categoria")
     */
    public function postCategoriaIngredienteAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categoria = new CategoriaIngrediente();

        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($categoria);
            $em->flush();
            return $categoria;
        } else {
            return $form;
        }
    }

    /**
     * @Get("/categoria")
     */
    public function getCategoriasIngredienteAction() {

        $categorias = $this->getDoctrine()->getRepository("AppBundle:CategoriaIngrediente")
                ->findAll();
        if (!$categorias)
            throw new BadRequestHttpException('No hay categorías');

        return ($categorias);
    }

}
