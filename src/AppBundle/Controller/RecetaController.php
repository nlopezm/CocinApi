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
use AppBundle\Entity\CategoriaReceta;
use AppBundle\Form\CategoriaType;
use AppBundle\Form\RecetaType;
use AppBundle\Entity\Receta;
use AppBundle\Entity\ItemReceta;
use AppBundle\Entity\Ingrediente;
use AppBundle\Form\PasoType;
use AppBundle\Entity\Paso;
use AppBundle\Form\ItemRecetaType;

class RecetaController extends FOSRestController {

    /**
     * @Post("")
     */
    public function postRecetaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $ingredientes = $request->get('ingredientes');
        $request->request->remove('ingredientes');
        $pasos = $request->get('pasos');
        $request->request->remove('pasos');

        $receta = new Receta();
        $form = $this->createForm(RecetaType::class, $receta);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($receta);
            $em->flush();
            $id = $receta->getId();

            foreach ($ingredientes as $ingrediente) {
                $item = new ItemReceta;
                $form = $this->createForm(ItemRecetaType::class, $item);
                $form->submit(array('ingrediente' => $ingrediente['ingrediente'], 'cantidad' => $ingrediente['cantidad'], 'receta' => $id));
                if ($form->isValid()) {
                    $em->persist($item);
                    $em->flush();
                    $receta->addIngrediente($item);
                }
            }
            
            foreach ($pasos as $paso) {
                $item = new Paso;
                $form = $this->createForm(PasoType::class, $item);
                $form->submit(array('nombre' => $paso['nombre'], 'descripcion' => $paso['descripcion'], 'receta' => $id));
                if ($form->isValid()) {
                    $em->persist($item);
                    $em->flush();
                    $receta->addPaso($item);
                }
            }
            return $receta;
        } else {
            return $form;
        }
    }

    /**
     * @Get("")
     */
    public function getRecetasAction() {

        $recetas = $this->getDoctrine()->getRepository("AppBundle:Receta")
                ->findAll();
        if (!$recetas)
            throw new BadRequestHttpException('No hay recetas');

        return ($recetas);
    }

    /**
     * @Post("/categoria")
     */
    public function postCategoriaRecetaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $categoria = new CategoriaReceta();

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
    public function getCategoriasRecetaAction() {

        $categorias = $this->getDoctrine()->getRepository("AppBundle:CategoriaReceta")
                ->findAll();
        if (!$categorias)
            throw new BadRequestHttpException('No hay categorías');

        return ($categorias);
    }

}
