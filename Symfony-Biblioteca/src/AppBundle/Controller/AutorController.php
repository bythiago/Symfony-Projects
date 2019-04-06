<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Autor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AutorController extends Controller
{
    /**
     * @Route("/autor/create", name="app_autor_create")
     */
    public function createAction()
    {
        $autores = array('J. K. Rowling', 'Stephen King', 'Paulo Coelho');

        $em = $this->getDoctrine()->getManager();
        $autor = new Autor();

        foreach ($autores as $e) {
            $autor->setNome(strtoupper($e));
            $em->persist($autor);
            $em->flush();
            $em->clear();
        }

        return new Response('Autores criados com sucesso!');
    }
}
