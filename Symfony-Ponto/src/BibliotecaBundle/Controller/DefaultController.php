<?php

namespace BibliotecaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


use BibliotecaBundle\Entity\Livro;
use BibliotecaBundle\Entity\Editora;

class DefaultController extends Controller
{
    /**
     * @Route("/livro/{id}/{nome}", name="livro")
     */
    public function indexAction($id, $nome)
    {
    	$em      = $this->getDoctrine()->getManager();
    	$editora = $this->getDoctrine()->getRepository('BibliotecaBundle:Editora')->find(1);
    	$livro   = $this->getDoctrine()->getRepository('BibliotecaBundle:Livro')->find($id);
    
    	$livro->setNome($nome);
    	$livro->setEditora($editora);

    	$em->persist($livro);
    	$em->flush();

    	return new Response('Book updated with success');
    }

    /**
     * @Route("/create-livros/{nome}", name="livro_create")
     */
    public function livroCreateAction($nome)
    {


    	$em    = $this->getDoctrine()->getManager();
    	$editora = $this->getDoctrine()->getRepository('BibliotecaBundle:Editora')->find(1);
    	$livro = new Livro();
    
    	$livro->setNome($nome);
    	$livro->setEditora($editora);

    	$em->persist($livro);
    	$em->flush();

    	return new Response('Book updated with success');
    }

    /**
     * @Route("/editora", name="editora")
     */
    public function editoraAction(){

    	$livro = $this->getDoctrine()->getRepository('BibliotecaBundle:Livro')->findAll();
    	

    	return $this->render('BibliotecaBundle:Default:index.html.twig', array(
    		'livros' => $livro
    	));
    }

    /**
     * @Route("/excluir/{id}", name="excluir")
     */
    public function livroExcluirAction($id){

    	$em = $this->getDoctrine()->getManager();
    	$livro = $this->getDoctrine()->getRepository('BibliotecaBundle:Livro')->find($id);

    	$em->remove($livro);
    	$em->flush();

    	//return $this->redirect('livro');
    	return new Response('Deleted with success');
    }

	/**
	* @Route("/livros/lista", name="livros_lista")
	*/
    public function livrosListaAction(){

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: *");

    	return new Response(
    		$this->toJson($this->getDoctrine()->getRepository('BibliotecaBundle:Livro')->findFiveBooks(4))
    	);
    }

    /**
     * @Route("/livros/index", name="livros_index")
     */
    public function livrosTableAction(){
    	return $this->render("BibliotecaBundle:Default:livro.html.twig");
    }

    /**
     * @Route("/livros-angular/index", name="livros_angular_index")
     */
    public function livrosAngularTableAction(){
        return $this->render("BibliotecaBundle:Default:livro-angular.html.twig");
    }

    private function toJson($object){
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($object, 'json');
    }

}
