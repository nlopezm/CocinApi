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
use AppBundle\Entity\InformacionNutricional;

class RecetaController extends FOSRestController {

    /**
     * @Post("")
     */
    public function postRecetaAction(Request $request) {
        $this->container->get('monolog.logger.conexiones')->info($this->container->get('request_stack')->getCurrentRequest()->getClientIp()." POST RECETA");
        $em = $this->getDoctrine()->getManager();
        $ingredientes = $request->get('ingredientes');
        $request->request->remove('ingredientes');
        $pasos = $request->get('pasos');
        $request->request->remove('pasos');
        $creador = $this->getDoctrine()->getRepository("AppBundle:Usuario")->findOneByMail($request->get('creador'));
        $request->request->remove('creador');

        $receta = new Receta();
        $form = $this->createForm(RecetaType::class, $receta);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($receta);
            $em->flush();
            $id = $receta->getId();
            $receta->setCreador($creador);

            $info = new InformacionNutricional();
            $apto_para = $this->getDoctrine()->getRepository("AppBundle:EnfermedadAlimenticia")
                    ->findAll();

            foreach ($ingredientes as $ingrediente) {
                $item = new ItemReceta;
                $form = $this->createForm(ItemRecetaType::class, $item);
                $form->submit(array('ingrediente' => $ingrediente['ingrediente'], 'cantidad' => $ingrediente['cantidad'], 'receta' => $id));
                if ($form->isValid()) {
                    $em->persist($item);
                    $em->flush();
                    $receta->addIngrediente($item);
                    $info->addAll($item->getIngrediente()->getInfoNutricional(), $item->getCantidad());
                    $apto_para = $this->join($apto_para, $item->getIngrediente()->getAptoPara()->toArray());
                }
            }
            $receta->setAptoPara($apto_para);
            $receta->setInfoNutricional($info);
            $em->persist($receta);
            $em->flush();
            if ($pasos) {
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
        $this->container->get('monolog.logger.conexiones')->info($this->container->get('request_stack')->getCurrentRequest()->getClientIp()." GET RECETAS");

        $recetas = $this->getDoctrine()->getRepository("AppBundle:Receta")
                ->findAll();
        if (!$recetas)
            throw new BadRequestHttpException('No hay recetas');

        return ($recetas);
    }

    /**
     * @Delete("/{id}")
     */
    public function deleteRecetaAction($id) {
        $this->container->get('monolog.logger.conexiones')->info($this->container->get('request_stack')->getCurrentRequest()->getClientIp()." DELETE RECETA ".$id);
        $em = $this->getDoctrine()->getManager();

        $receta = $this->getDoctrine()->getRepository("AppBundle:Receta")
                ->find($id);
        if (!$receta)
            throw new BadRequestHttpException('No existe la receta');
        $usuarios = $this->getDoctrine()->getRepository("AppBundle:Usuario")->findAll();
        $query = 'delete FROM usuario_favorito where receta_id = ' . $id;
        $statement = $em->getConnection()->prepare($query);
        $statement->execute();

        $em->remove($receta);
        $em->flush();
        return 200;
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

    private function join($array1, $array2) {
        $output = [];
        foreach ($array2 as $value) {
            foreach ($array1 as $value2)
                if ($value->getId() == $value2->getId())
                    $output[] = $value;
        }
        return $output;
    }

}
