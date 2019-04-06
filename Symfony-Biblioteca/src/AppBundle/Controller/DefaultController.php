<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Autor;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Editora;
use AppBundle\Entity\Livro;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Emprestimo;
use AppBundle\Entity\UsuarioEmprestimo;
use AppBundle\Entity\LivroCategoria;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction()
    {
        print 'haerhaehr';
        exit;
    }
	/**
     * @Route("/usuario-emprestimo", name="usuario-emprestimo")
     */
    public function usuarioEmprestimoAction(Request $request){

    	//Entity
    	$emprestimo = new Emprestimo();
    	$usuarioEmprestimo = new UsuarioEmprestimo();

    	//Repository
    	$usuario = $this->getDoctrine()->getRepository('AppBundle:Usuario');
    	$livro = $this->getDoctrine()->getRepository('AppBundle:Livro');

    	//Entity Manager
    	$em = $this->getDoctrine()->getManager();
    	
    	$emprestimo->setIdLivro($livro->find(2));
    	$emprestimo->setDataEmprestimo(date('d-m-Y'));
    	$emprestimo->setStatus(1);
    	
    	$usuarioEmprestimo->setIdUsuario($usuario->find(1));
    	$usuarioEmprestimo->setIdEmprestimo($emprestimo);

    	$em->persist($emprestimo);
    	$em->persist($usuarioEmprestimo);
    	$em->flush();

    	return new Response('created with success');
    }


    /**
     * @Route("/usuario", name="usuario")
     */
    public function usuarioAction(Request $request){

    	$em = $this->getDoctrine()->getManager();
    	$usuario = new Usuario();
    	$usuario->setNome('Thiago Vieira de Carvalho');
    	$usuario->setNascimento('01-01-2001');
    	$usuario->setSexo('M');
    	$usuario->setCep('11111111');
    	$usuario->setCpf('11111111111');
    	$usuario->setContato('11111111111');
    	$usuario->setStatus('1');

    	$em->persist($usuario);
    	$em->flush();

    	return new Response('created with success');
    }

    /**
     * @Route("/livro", name="livro")
     */
    public function indexAction(Request $request){
    	
    	$em = $this->getDoctrine()->getManager();
    	$livro = new Livro();
    	$livroCategoria = new LivroCategoria();

    	$categoria = $this->getDoctrine()->getRepository('AppBundle:Categoria')->find(1);
    	$editora = $this->getDoctrine()->getRepository('AppBundle:Editora')->find(1);
    	$autor = $this->getDoctrine()->getRepository('AppBundle:Autor')->find(1);
    	

    	$livro->setNome('O PODER DA AÇÃO');
    	$livro->setDescricao('Acorde para os objetivos que quer conquistar.
Já aconteceu a você de se olhar no espelho e não gostar daqueles quilos a mais? De observar seu momento profissional somente com frustração?');
    	$livro->setLancamento('01-01-2015');
    	
    	$livro->setIdEditora($editora);
    	$livro->setIdAutor($autor);

    	$livroCategoria->setIdCategoria($categoria);
    	$livroCategoria->setIdLivro($livro);

    	$em->persist($livro);
    	$em->persist($livroCategoria);
    	$em->flush();

    	return new Response('created with success');
    }

    /**
     * @Route("/select", name="select")
     */
    public function selectAction(Request $request){
    	$repository = $this->getDoctrine()->getRepository('AppBundle:Usuario');

    	print '<pre>';
    	print_r($repository->findAll());
    	print '</pre>';
    	exit;
    }
  
}
