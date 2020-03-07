<?php

namespace AppBundle\Controller;

use AppBundle\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Categoria;


class DefaultController extends Controller
{

    /**
     * @Route("/categoria/edit", name="select")
     */
    public function selectAction(Request $request){

        /**
         * @var EntityManager $em
         */
        $em = $this->getDoctrine()->getManager();

        /** @var Categoria $categoria */
    	$categoria = $this->getDoctrine()->getRepository('AppBundle:Categoria')->find(6);


    	$em->persist($categoria->setNome('COMEDIA' . rand(1, 99)));
    	$em->flush();

        return new Response('Categoria atualizado com sucesso');
    }

        /**
     * @Route("/livros1", name="livros1")
     */
    public function livrosAction(){
        $livros = $this->getDoctrine()->getRepository('AppBundle:Livro')->findAll();

        print '<pre>';
        foreach ($livros as $livro) {
            if($livro->hasAutor()){
                var_dump($livro->getIdAutor()->getNome());                
            }
        }

        //var_dump($aaa );

        exit;
    }
  
}
