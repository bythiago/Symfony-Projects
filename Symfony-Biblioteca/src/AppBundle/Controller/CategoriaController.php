<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoriaController
 * @package AppBundle\Controller
 */
class CategoriaController extends Controller
{
    /**
     * @Route("/categoria/create", name="app_categoria_create")
     */
    public function createAction()
    {
        $categorias = array('FICÇÃO', 'COMEDIA', 'TERROR');

        $em = $this->getDoctrine()->getManager();
        $categoria = new Categoria();

        foreach ($categorias as $c) {
            $categoria->setNome(strtoupper($c));
            $em->persist($categoria);
            $em->flush();
            $em->clear();
        }

        return new Response('Categorias criadas com sucesso!');
    }
}


