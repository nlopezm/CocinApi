<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

class UsuarioController extends FOSRestController {

    /**
     * @Post("")
     */
    public function postUsuarioAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em->persist($usuario);
            $em->flush();
            return $usuario;
        } else {
            return $form;
        }
    }

    /**
     * @Post("/favorito")
     */
    public function postFavoritoAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $receta = $this->getDoctrine()->getRepository("AppBundle:Receta")->find($request->get('receta'));
        $usuario = $this->getDoctrine()->getRepository("AppBundle:Usuario")->findOneByMail($request->get('usuario'));
        if (!$receta)
            throw new BadRequestHttpException('No existe la receta');
        if (!$usuario)
            throw new BadRequestHttpException('No existe el usuario');

        $usuario->addFavorito($receta);
        $em->persist($usuario);
        $em->flush();
        return $usuario;
    }

    /**
     * @Get("/favorito/{email}")
     */
    public function getFavoritosAction($email) {
        $em = $this->getDoctrine()->getManager();

        $usuario = $this->getDoctrine()->getRepository("AppBundle:Usuario")->findOneByMail($email);
        if (!$usuario)
            throw new BadRequestHttpException('No existe el usuario');

        return $usuario->getFavoritos();
    }
    
    /**
     * @QueryParam(name="receta")
     * @QueryParam(name="usuario")
     * @Delete("/favorito")
     */
    public function deleteFavoritoAction(ParamFetcherInterface $paramFetcher) {
        $em = $this->getDoctrine()->getManager();
        
        $usuario = $this->getDoctrine()->getRepository("AppBundle:Usuario")->findOneByMail($paramFetcher->get('usuario'));

        if (!$usuario)
            throw new BadRequestHttpException('No existe el usuario');

        $usuario->deleteFavorito($paramFetcher->get('receta'));
        $em->persist($usuario);
        $em->flush();
        return $usuario;
    }

}
