<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Editora;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EditoraController
 * @package AppBundle\Controller
 */
class EditoraController extends Controller
{
    /**
     * @Route("/editora/create", name="app_editora_create")
     */
    public function createAction(){

        $editoras = array('ELSEVIER', 'GLOBO', 'NOVO SECULO');

        $em = $this->getDoctrine()->getManager();
        $editora = new Editora();

        foreach ($editoras as $e) {
            $editora->setNome($e);
            $em->persist($editora);
            $em->flush();
            $em->clear();
        }

        return new Response('Editoras criadas com sucesso!');

    }

    /**
     * @Route("/editora/read", name="app_editora_read")
     */
    public function readAction(){
        $em = $this->getDoctrine();
        $editoras = $em->getRepository('AppBundle:Editora')->findAll();

        print '<pre>';
        print_r($editoras);
        print '</pre>';
        exit;
    }
}
