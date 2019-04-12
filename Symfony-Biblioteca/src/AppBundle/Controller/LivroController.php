<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use AppBundle\Entity\Livro;
use AppBundle\Entity\LivroCategoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class LivroController
 * @package AppBundle\Controller
 */
class LivroController extends Controller
{
    /**
     * @Route("/livro/create", name="app_livro_create")
     */
    public function createAction()
    {
        $em    = $this->getDoctrine()->getManager();
        $livro = new Livro();

        $livro->setNome('O Querido John');
        $livro->setDescricao('Your application is full of useful objects: a "Mailer" object might help you send emails while another object might help you save things to the database.');
        $livro->setLancamento('01-01-2001');
        $livro->setIdEditora($this->findEditora());
        $livro->setIdAutor($this->findAutor());

        $em->persist($livro);

        foreach(array(0,2) as $categorias){
            $livroCategoria = new LivroCategoria();
            $livroCategoria->setIdLivro($livro);
            $livroCategoria->setIdCategoria($this->findCategoria());
            $em->persist($livroCategoria);
        }

        $em->flush();
        $em->clear();

        return new Response('Livros cadastrados com sucesso!');
    }

    /**
     * @Route("/livro/list/all", name="app_livro_list_all")
     */
    public function getLivros(){

        $livros = $this->getDoctrine()->getRepository('AppBundle:Livro')->findAll();
        $response = new Response($this->serializer($livros), 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @return object
     */
    private function findEditora(){
        return $this->getDoctrine()->getRepository('AppBundle:Editora')->find(rand(1, 3));
    }

    /**
     * @return object
     */
    private function findAutor(){
        return $this->getDoctrine()->getRepository('AppBundle:Autor')->find(rand(1, 3));
    }

    /**
     * @return object
     */
    private function findCategoria(){
        return $this->getDoctrine()->getRepository('AppBundle:Categoria')->find(rand(1, 3));
    }

    /**
     * @param $object
     * @param string $type
     * @return mixed
     */
    private function serializer($object, $type = 'json'){
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($object, $type);

    }

}
